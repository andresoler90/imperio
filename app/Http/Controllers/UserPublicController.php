<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Libs\BonusMethods;
use App\Http\Controllers\Libs\Multilevel;
use App\Mail\Users\CloseAccountMail;
use App\Models\Bonus;
use App\Models\CalendarEvent;
use App\Models\Country;
use App\Models\KycType;

use App\Models\Membership;
use App\Models\MembershipPoolUpgrades;
use App\Models\MembershipReinvestment;
use App\Models\MembershipVerifications;
use App\Models\PaymentCoinbase;
use App\Models\Rank;
use App\Models\System;
use App\Models\TaskDetail;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketPriority;
use App\Models\TicketResponse;
use App\Models\TicketStatus;
use App\Models\UserBalance;
use App\Models\UserBonus;
use App\Models\UserBonusRetained;
use App\Models\UserComunication;
use App\Models\UserContactInformation;
use App\Models\UserMembership;
use App\Models\UserPaymentRequest;
use App\Models\UserScore;
use App\Models\UserTransfer;
use App\Models\PaymentMercadoPago;
use App\Models\UserBalanceRoi;
use App\Models\UserRoiRequest;
use App\User;
use Carbon\Carbon;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use Doctrine\DBAL\Schema\View;
use Faker\Provider\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PragmaRX\Google2FA\Google2FA;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use MercadoPago;
use Zendesk\API\Resources\Core\Users;

class UserPublicController extends Controller
{

    public function kyc()
    {
        $types = KycType::all();
        return view('user.kyc', compact('types'));
    }

    public function wallet(Request $request)
    {
        $balances = UserBalance::where('users_id', Auth::id())->orderByDesc('created_at')->paginate(4);
        $balances_name = UserTransfer::where('from_users_id', Auth::id())->first();
        $referred = Auth::user()->referreds()->pluck('username', 'username')->toArray();

        if ($balances_name) {
            $name = User::where('id', $balances_name->to_users_id)->first();
        } else {
            $name = "";
        }
        $fee = System::where('parameter', 'transfer_percentage')->first();
        $feeValue = $fee->value;
        $type = $request->type;
        $date = $request->date;

        if ($type) {
            $balances = UserBalance::where([
                ['users_id', Auth::id()],
                ['type', 'like', '%' . $request->type . '%']
            ])->orderByDesc('id')->paginate(1);
        }
        if ($date != null) {
            $balances = UserBalance::where('users_id', Auth::id())->whereDate('created_at', $request->date)->orderByDesc('id')->paginate(4);
        }

        return view('user.wallet', compact('balances', 'feeValue', 'type', 'date', 'name', 'referred'));
    }

    public function roi(Request $request)
    {
        $balances = UserBalanceRoi::where('users_id', Auth::id())->orderByDesc('created_at')->paginate(4);
        $saldo = UserBalanceRoi::where('users_id', Auth::id())->sum('amount');
        $balances_name = UserTransfer::where('from_users_id', Auth::id())->first();
        $referred = Auth::user()->referreds()->pluck('username', 'username')->toArray();

        if ($balances_name) {
            $name = User::where('id', $balances_name->to_users_id)->first();
        } else {
            $name = "";
        }
        $fee = System::where('parameter', 'transfer_percentage')->first();
        $feeValue = $fee->value;
        $type = $request->type;
        $date = $request->date;

        if ($type) {
            $balances = UserBalanceRoi::where([
                ['users_id', Auth::id()],
                ['type', 'like', '%' . $request->type . '%']
            ])->orderByDesc('id')->paginate(1);
        }
        if ($date != null) {
            $balances = UserBalanceRoi::where('users_id', Auth::id())->whereDate('created_at', $request->date)->orderByDesc('id')->paginate(4);
        }

        return view('user.roi', compact('balances', 'feeValue', 'type', 'date', 'name', 'referred', 'saldo'));
    }

    public function settings()
    {
        $login = new LoginController();
        $tokenLogin = (new Google2FA)->generateSecretKey();
        $user = User::find(Auth::id());
        $user->token_login = $tokenLogin;
        $urlQR = $login->createUserUrlQR($user);
        return view('user.settings', compact('urlQR', 'tokenLogin'));
    }

    public function activateA2fa(Request $request)
    {
        $user = Auth::user();
        if ((new Google2FA())->verifyKey($request->tokenLogin, $request->code)) {
            if (isset($request->tokenLogin)) {
                $user->token_login = $request->tokenLogin;
            } else {
                $user->token_login = null;
            }
            if ($user->save()) {
                if ($user->token_login) {
                    Alert::success(__('Autenticación de doble factor'), 'Deberá ingresar la clave dinámica en cada login o opción donde se le solicite');
                } else {
                    Alert::success(__('Autenticación de doble factor'), 'Se ha desactivado esta opción ');
                }
            }
        } else {
            \Alert::warning('', __('Clave errada'));
        }

        return redirect()->back();
    }

    public function deactivateA2fa(Request $request)
    {

        if ((new Google2FA())->verifyKey(Auth::user()->token_login, $request->code)) {
            $user = Auth::user();
            $user->token_login = null;
            if ($user->save()) {
                Alert::success('Autenticación de doble factor', __("Desactivado"));
            }
        } else {
            Alert::warning('Autenticación de doble factor', __("Clave errada"));
        }

        return redirect()->back();
    }

    public function payment()
    {
        //$payment = UserPaymentRequest::where('users_id', Auth::id());

        $payments = new \stdClass();
        $payments->pendings = UserPaymentRequest::where('users_id', Auth::id())->Pending()->paginate(15);
        $payments->refuses = UserPaymentRequest::where('users_id', Auth::id())->Refuse()->paginate(15);
        $payments->approves = UserPaymentRequest::where('users_id', Auth::id())->Approve()->paginate(15);
        $remove_commission = System::where('parameter', 'remove_commission')->first();

        return view('user.payment', compact('payments', 'remove_commission'));
    }

    public function roiRetirement()
    {
        //$payment = UserPaymentRequest::where('users_id', Auth::id());

        $payments = new \stdClass();
        $payments->pendings = UserRoiRequest::where('users_id', Auth::id())->Pending()->paginate(15);
        $payments->refuses = UserRoiRequest::where('users_id', Auth::id())->Refuse()->paginate(15);
        $payments->approves = UserRoiRequest::where('users_id', Auth::id())->Approve()->paginate(15);
        $remove_commission = System::where('parameter', 'remove_commission')->first();

        return view('user.roi_payment', compact('payments', 'remove_commission'));
    }


    public function savePaymentRequest(Request $request)
    {

        $balance = \Auth::user()->balanceTotal();
        $remove_minimum = System::where('parameter', 'remove_minimum')->first();
        $remove_commission = System::where('parameter', 'remove_commission')->first();

        // Se agrega 1 dia para coincidencia de las opciones

        if ($request->wallet_source == "legacy") {
            if ($this->validateLegacyWithdraws($request->amount_remove)) {
                $validatePayment = LegacyPaymentRequest::where('users_id', \Auth::id())->Pending()->first();
            } else {
                return redirect()->route('user.payment');
            }
        } else {
            $validatePayment = UserPaymentRequest::where('users_id', \Auth::id())->Pending()->first();
        }

        if ($validatePayment != null) {
            \Alert::warning('', __('Ya hay una solicitud de retiro vigente'));
        } elseif ($request->amount_remove > $balance) {
            \Alert::warning('', __('La cantidad solicitada es superiror al monto actual: $' . $balance));
        } elseif ($request->amount_remove < $remove_minimum->value) {
            \Alert::warning('', __('La cantidad solicitada es inferior al monto minimo: $' . $remove_minimum->value));
        } else {

            $payment = new UserPaymentRequest();

            // Comision sobre el valor retirado
            $commission = (((float)$request['amount_remove'] * $remove_commission->value) / 100);
            // Se resta comision del valor total
            $request['amount_remove'] = ((float)$request['amount_remove'] - $commission);

            $payment->fill($request->all());
            $payment->users_id = \Auth::id();
            $payment->status = 0; // Pendiente
            $payment->remove_commission = $commission;
            if ($payment->save()) {
                Alert::success('', __('Solicitud de pago registrada'));
            }
        }
        return redirect()->route('user.payment');//TODO: se deja redirect route y no el back, ya que el back es el middleware 2FA
    }

    public function savePaymentROIRequest(Request $request)
    {

        $balance = \Auth::user()->balanceRoiTotal();
        $remove_minimum = System::where('parameter', 'remove_minimum')->first();
        $remove_commission = System::where('parameter', 'remove_commission')->first();

        $validatePayment = UserRoiRequest::where('users_id', \Auth::id())->Pending()->first();

        if ($validatePayment != null) {
            \Alert::warning('', __('Ya hay una solicitud de retiro vigente'));
        } elseif ($request->amount_remove > $balance) {
            \Alert::warning('', __('La cantidad solicitada es superiror al monto actual: $' . $balance));
        } elseif ($request->amount_remove < $remove_minimum->value) {
            \Alert::warning('', __('La cantidad solicitada es inferior al monto minimo: $' . $remove_minimum->value));
        } else {

            $payment = new UserRoiRequest();

            // Comision sobre el valor retirado
            $commission = (((float)$request['amount_remove'] * $remove_commission->value) / 100);
            // Se resta comision del valor total
            $request['amount_remove'] = ((float)$request['amount_remove'] - $commission);

            $payment->fill($request->all());
            $payment->users_id = \Auth::id();
            $payment->status = 0; // Pendiente
            $payment->remove_commission = $commission;
            if ($payment->save()) {
                Alert::success('', __('Solicitud de pago registrada'));
            }
        }
        return redirect()->route('user.paymentRoi');//TODO: se deja redirect route y no el back, ya que el back es el middleware 2FA
    }

    public function validateLegacyWithdraws($amount)
    {
        $legacy_start_request = System::where("parameter", "legacy_start_request")->first();
        $start = new \DateTime($legacy_start_request->value);
        $end = new \DateTime(date('Y-m-d', strtotime("this week +7 days")));
        $interval = $start->diff($end);
        $weeks = floor(($interval->format('%a') / 7));

        $legacy_limit_request = System::where("parameter", "legacy_limit_request")->first();

        $totalLimit = ($legacy_limit_request->value * $weeks);

        $requestAmount = LegacyBalance::where("users_id", Auth::id())->where("amount", "<", 0)->get()->sum("amount");
        $realLimit = $totalLimit + $requestAmount;
        if ($realLimit < $amount) {
            Alert::warning("El monto supera el limite acumulado de $realLimit");
            return false;
        }

        return true;
    }

    public function transfer(Request $request)
    {
        $userTransfer = User::where('username', $request->name)->first();
        // Preguntar sobre este dd que no está comentado.
        //dd($request, $userTransfer);
        $feeValue = System::where('parameter', 'transfer_percentage')->first();
        $total_amount = Auth::user()->balanceTotal();

        $fee = $feeValue->value / 100;
        $totalFee = $request->amount_transfer * $fee;
        $discount = $request->amount_transfer + $totalFee;

        if ($userTransfer) {

            if ($discount > $total_amount) {
                Alert::error('', 'El monto a transferir no debe superar el monto actual');
            } else {

                if ($userTransfer->id != Auth::id()) {
                    $originBalances = new UserBalance();
                    $originBalances->users_id = $userTransfer->id;
                    $originBalances->amount = $request->amount_transfer;
                    $originBalances->type = 'transfer';
                    $originBalances->created_user = Auth::id();
                    $originBalances->save();
                } else {
                    Alert::error('', 'No puede hacer una transferencia al mismo usuraio');
                    return redirect()->back();
                }

                $destinedBalances = new UserBalance();
                $destinedBalances->users_id = Auth::id();
                $destinedBalances->amount = $discount * -1;
                $destinedBalances->type = 'transfer';
                $destinedBalances->created_user = Auth::id();
                if ($destinedBalances->save()) {
                    $transfer = new UserTransfer();
                    $transfer->from_users_id = Auth::id();
                    $transfer->from_balance_id = $destinedBalances->id;
                    $transfer->to_users_id = $userTransfer->id;
                    $transfer->to_balance_id = $originBalances->id;
                    $transfer->comment = $request->comment;
                    $transfer->save();

                    Alert::success('', 'Se realizo la transacción con exito');
                } else {
                    Alert::error('', 'Error al momento de guardar la transacción');
                }
            }

        } else {
            Alert::error('', 'El usuario no se encuentra registrado');
        }

        return redirect()->back();

    }

    /**
     * @param $membership
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payWallet($membership)
    {

        $pay = UserMembership::where('id', $membership)->first();
        $payment_membership_fee = System::where("parameter", "payment_membership_fee")->first();//Fee
        $total_amount = Auth::user()->balanceTotal();

        if (($pay->price + $payment_membership_fee->value) > $total_amount) {
            Alert::error('El monto de la suscripcion supera el monto en su wallet');
            return redirect()->back();
        } else {
            $walletBalances = new UserBalance();
            $walletBalances->users_id = Auth::id();

            $walletBalances->amount = $pay->price * -1;
            $walletBalances->type = 'pay_membership';
            $walletBalances->created_user = Auth::id();
            if ($walletBalances->save()) {
                $pay->status = 'A';
                if ($pay->save()) {
                    //Procedemos a cobrar el fee

                    $userFee = new UserBalance();
                    $userFee->users_id = Auth::id();
                    $userFee->amount = $payment_membership_fee->value * -1;
                    $userFee->type = "pay_membership_fee";
                    $userFee->created_user = Auth::id();
                    if ($userFee->save()) {
                        Alert::success('', 'Se realizo el pago de la membresia con exito');
                        $multilevel = new Multilevel(Auth::user());
                        $multilevel->startBonus($pay->price);
                        $multilevel->tripleBonus();
                        return redirect()->back();
                    }
                }
            } else {
                Alert::error('', 'Error al momento de hacer el pago de la menbresia');
                return redirect()->back();
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function reply($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('user.reply', compact('user'));
        }
        return redirect()->route('login');
    }

    function multilevel()
    {
        $user = Auth::user();
        $multilevel = new Multilevel($user);
        $nodes = $multilevel->underPlain();
        $nextNode = $multilevel->nextEmpty($user->position_preference);
        $nextNode->parent = User::find($nextNode->parent_users_id);
        $referreds = User::where('sponsor_id', Auth::id())->get();
        return view('user.multilevel', compact("multilevel", 'nodes', 'nextNode', 'referreds'));
    }

    public function addUserReferenced()
    {
        return view('user.add_user_reference');

    }

    public function createUserReferenced(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'string', 'min:4', 'unique:users'],
            'countries_id' => ['required'],
            'sponsor' => ['required', 'exists:users,username'],
        ]);
        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withErrors($validate)
                ->withInput();
        }

        $sponsor = User::where('username', $request['sponsor'])->first();
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'username' => $request['username'],
            'countries_id' => $request['countries_id'],
            'sponsor_id' => $sponsor->id,
        ]);
        /*
                if ($user) {
                    $membership = Membership::find($request["memberships_id"]);
                    $userMembership = new UserMembership();
                    $userMembership->users_id = $user->id;
                    $userMembership->memberships_id = $membership->id;
                    $userMembership->price = $membership->amount;
                    $userMembership->save();
                }
        */
        Alert::success('', __('Usuario creado correctamente'));

        return redirect()->back();

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listEmail()
    {

        $users = User::all()->pluck('name', 'id');
        $listEmailTo = UserComunication::where('to_users_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $listEmailForm = UserComunication::where('from_users_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('user.email', compact('users', 'listEmailTo', 'listEmailForm'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request)
    {
        $userToEmail = User::where('id', $request->users_id)->first();

        if ($userToEmail) {
            $sendEmail = new UserComunication();
            $sendEmail->subject = $request->subject;
            $sendEmail->message = $request->message;
            $sendEmail->from_users_id = Auth::id();
            $sendEmail->to_users_id = $userToEmail->id;
            if ($sendEmail->save()) {
                Alert::success('', 'Email enviado con exito');
            } else {
                Alert::error('', 'No se pudo enviar el Email');
            }
        }

        return redirect()->back();
    }

    public function sendPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        //dd($user);
        if ($user) {
            $obj = new \App\Http\Controllers\Admin\UserController();
            //  dd($obj);
            return $obj->resetPassword($user);
        }

        Alert::success('Contraseña', 'Se ha enviado un enlace a su correo para cambiar cu contraseña');
        return redirect()->route('login');
    }

    public function loadVerificationPayment(Request $request)
    {

        $validated = $request->validate([
            "support_document" => "required|mimes:jpg,jpeg,png,pdf",
            "membership_id" => "required"
        ]);
        $registration = System::where('parameter', 'registration_value')->first();
        $kyc_for_buy = System::where('parameter', 'kyc_for_buy')->first();


        if ($kyc_for_buy->value) {
            $validateKyc = Auth::user()->hasValidKyc();
        } else {
            $validateKyc = true;
        }


        if ($validateKyc) {

            $membership = Membership::find($request->membership_id);
            if ($membership) {
                $userMembership = UserMembership::where('users_id', Auth::id())->first();
                if (!isset($userMembership)) {
                    $userMembership = new UserMembership();
                    $userMembership->users_id = Auth::id();
                    $userMembership->memberships_id = $membership->id;
                    $userMembership->price = $membership->amount + (int)$registration->value;
                    $userMembership->save();
                }

                $file = $request->file('support_document');

                $verification = new MembershipVerifications();
                $verification->fill($request->all());
                $verification->support_document = $file->getClientOriginalName();
                $verification->user_memberships_id = $userMembership->id;

                if ($verification->save()) {
                    $request->support_document->storeAs('users/' . Auth::id() . '/memberships_verifications/', $verification->id . '.' . $file->getClientOriginalExtension());
                    Alert::success('', 'Registro exitoso');
                    return redirect()->back();
                }
            }
        } else {
            Alert::warning(__('KYC'), __('Para poder realizar la solicitud de activación de la membresía debe cumplir con todos los documentos del KYC'))->persistent(true);
            return redirect()->route('user.kyc');
        }
    }

    public function listTickets()
    {
        $tickets = [];
        $statuses = TicketStatus::where('active', 1)->get();
        $categories = TicketCategory::where('active', 1)->pluck('category_name', 'id');
        $priorities = TicketPriority::where('active', 1)->pluck('priority_name', 'id');


        foreach ($statuses as $status) {
            if (Auth::user()->roles_id != 1) {
                $tickets[$status->status_name] = Ticket::where('users_id', Auth::id())->where('status_id', $status->id)->paginate(15);
            } else {
                $tickets[$status->status_name] = Ticket::where('status_id', $status->id)->paginate(15);
            }
        }

        return view('user.ticket', compact('tickets', 'statuses', 'categories', 'priorities'));
    }

    public function tickets()
    {

        $categories = TicketCategory::where('active', 1)->pluck('category_name', 'id');
        $priorities = TicketPriority::where('active', 1)->pluck('priority_name', 'id');
        return view('user.add_ticket', compact('categories', 'priorities'));
    }

    public function storeTickets(Request $request)
    {
        $validated = $request->validate([
            "category_id" => "required",
            "priority_id" => "required",
            "subject" => "required",
            "message" => "required",
            "file" => " mimes:gif,jpg,png,jpeg,JPG"
        ]);

        $tiket = new Ticket();
        $tiket->users_id = Auth::id();
        $tiket->category_id = $request->category_id;
        $tiket->priority_id = $request->priority_id;
        $tiket->message = $request->message;
        $tiket->subject = $request->subject;
        $tiket->status_id = 1;

        $tikectByCategory = Ticket::select('*')->where('category_id', $tiket->category_id)->get();
        $tiket->code = $tiket->category->category_prefix . (count($tikectByCategory) + 1);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $tiket->file_path = $file->getClientOriginalName();
        }

        if ($tiket->save()) {
            if ($request->hasFile('file')) {
                $request->file->storeAs('users/' . $tiket->users_id . '/ticket/', $tiket->id . 'create.' . $file->getClientOriginalExtension());
            }
            Alert::success('Registro exitoso');
            return redirect()->route('user.ticket');
        }
    }

    public function detailTickets(Ticket $ticket)
    {
        $responses = TicketResponse::select('*')->where('ticket_id', $ticket->id)->get();
        $statuses = TicketStatus::where('active', 1)->get();
        return view('user.ticket_response', compact('ticket', 'responses', 'statuses'));
    }

    public function updateState(Ticket $ticket, $status_id)
    {
        if ($ticket) {
            $ticket->status_id = $status_id;
            if ($ticket->save()) {
                Alert::success('Actualización exitosa');
            } else {
                Alert::error('Actualización fallida');
            }
        }
        return redirect()->back();
    }

    public function responseTicket(Request $request)
    {
        $validated = $request->validate([
            "comment" => "required",
            "file" => " mimes:gif,jpg,png,jpeg,JPG"
        ]);

        $response = new TicketResponse();
        $response->ticket_id = $request->ticket_id;
        $response->users_id = Auth::id();
        $response->comment = $request->comment;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $response->file = $file->getClientOriginalName();
        }

        if ($response->save()) {
            $response->ticket->updated_at = Carbon::now();
            $response->ticket->save();
            if ($request->hasFile('file')) {
                $request->file->storeAs('users/' . $response->users_id . '/ticket/', $response->id . 'response.' . $file->getClientOriginalExtension());
            }
            Alert::success('Registro exitoso');
            return redirect()->back();
        } else {
            Alert::success('No se pudo actualizar el registro');
            return redirect()->back();
        }
    }

    public function downloadTicket(Ticket $ticket, $type = 1)
    {
        if ($type == 1) {
            // visualizacion
            $path = 'users/' . $ticket->users_id . '/ticket/' . $ticket->id . 'create.' . File::extension($ticket->file_path);

            return Storage::exists($path) ? Storage::response($path) : null;
        }
    }

    public function downloadTicketResponse(TicketResponse $response, $type = 1)
    {
        if ($type == 1) {
            // visualizacion
            $path = 'users/' . $response->users_id . '/ticket/' . $response->id . 'response.' . File::extension($response->file);
            return Storage::exists($path) ? Storage::response($path) : null;
        }
    }

    public function searchTicket(Request $request)
    {
        $tickets = [];
        $statuses = TicketStatus::where('active', 1)->get();
        $categories = TicketCategory::where('active', 1)->pluck('category_name', 'id');
        $priorities = TicketPriority::where('active', 1)->pluck('priority_name', 'id');
        foreach ($statuses as $status) {

            $ticket = Ticket::where('status_id', $status->id);

            if ($request->code != null) {
                $ticket->where('code', $request->code);
            }

            if ($request->user != null) {
                $user = User::where('username', $request->user)->first();
                if ($user) {
                    $ticket->where('users_id', $user->id);
                }
            }

            if ($request->category_id != null) {
                $ticket->where('category_id', $request->category_id);
            }

            if ($request->priority_id != null) {
                $ticket->where('priority_id', $request->priority_id);
            }

            if ($request->date_ini && $request->date_end != null) {
                $ticket->whereDate('created_at', '>=', $request->date_ini)->whereDate('created_at', '<=', $request->date_end);
            }

            $tickets[$status->status_name] = $ticket->orderBy('created_at', 'desc')->paginate();
        }

        return view('user.ticket', compact('tickets', 'statuses', 'categories', 'priorities'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function reinvestment(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $balanceTotal = number_format($user->balanceTotal(), 2, '.', '');
            $membershipUser = $user->membership;
            $nextMembership = $user->nextMembership();

            $validated = $request->validate([
                "amount" => "required|numeric|between:1,$balanceTotal",
                "description" => "required",
            ]);

            if (!$membershipUser) {
                Alert::error('No cuenta con una membresia activa');

            } elseif ($balanceTotal > 0 && $membershipUser != null) {
                $model = new MembershipReinvestment();
                $model->users_id = $user->id;
                $model->membership_id = $membershipUser->memberships_id;
                $model->fill($request->all());
                $model->save();

                $userBalances = new UserBalance();
                $userBalances->users_id = $user->id;
                $userBalances->amount = -$request->amount;
                $userBalances->type = 'reinvestment';
                $userBalances->created_user = $user->id;
                $userBalances->save();

                //upgrade membresia
                $upgradeMembership = $user->upgradeMembership();

                if ($upgradeMembership != null && $upgradeMembership->totalReinvesment >= $nextMembership->amount) {
                    $membershipUser->delete();
                    $newMembershipUser = new UserMembership();
                    $newMembershipUser->memberships_id = $upgradeMembership->id;
                    $newMembershipUser->users_id = $user->id;
                    $newMembershipUser->price = $upgradeMembership->totalReinvesment;
                    $newMembershipUser->expiration_date = '0000-00-00';//Todo: mirar que tiempo es el que se le debe asignar
                    $newMembershipUser->status = 'A';
                    $newMembershipUser->save();
                }
                DB::commit();
                Alert::success('Registro exitoso');
            } else
                Alert::error('Saldo insuficiente');

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error en el registro');
            return redirect()->back();
        }

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calendar()
    {
        $events = CalendarEvent::whereBetween('start_time', [
            date('Y-m-d') . ' 00:00:00',
            date('Y-m-d', strtotime('+5 days')) . ' 23:59:59'
        ])->get();

        return view('user.calendar', compact('events'));
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function pricing($type = '*')
    {
        if (Auth::user()->membershipActive) {
            $membershipList = Membership::where('type', 'membership')->where('id', '>', Auth::user()->membershipActive->memberships_id)->get();
        } else
            $membershipList = Membership::where('type', 'membership')->get();
        $poolUpgrade = MembershipPoolUpgrades::where('users_id', Auth::user()->id)->where('status', '=', 'P')->first();
        $subscriptionList = Membership::where('type', 'subscription')->get();
        $academyList = Membership::where('type', 'academys')->get();
        $registration = System::where('parameter', 'registration_value')->first();

        //Verificamos si ya existe un proceso de validacion pendiente
        if (Auth::user()->membership) {


            $membershiVerification = MembershipVerifications::whereIn('user_memberships_id', Auth::user()->membership->where('status', 'P')->pluck('id'))->get();
            //$PaymentCoinbaseVerification = PaymentCoinbase::whereIn('user_memberships_id', Auth::user()->membership->where('status', 'P')->pluck('id'))->get();
            $PaymentCoinbaseVerification = PaymentCoinbase::whereIn('user_memberships_id', [Auth::user()->membership->id])->where('status', 'P')->get();
            $PaymentMercadoPagoVerification = PaymentMercadoPago::whereIn('user_memberships_id', [Auth::user()->membership->id])->where('status', 'P')->get();
            //$PaymentMercadoPagoVerification = PaymentMercadoPago::whereIn('user_memberships_id', Auth::user()->membership->where('status', 'P')->pluck('id'))->get();
        } else {
            $membershiVerification = [];
            $PaymentCoinbaseVerification = [];
            $PaymentMercadoPagoVerification = [];
        }

        $countries = Country::all();

        return view('user.pricing', compact('membershipList', 'subscriptionList', 'academyList', 'membershiVerification', 'type', 'registration', 'poolUpgrade', 'PaymentCoinbaseVerification', 'PaymentMercadoPagoVerification', 'countries'));
    }

    /**
     * @param $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePosition($position)
    {
        $user = Auth::user();
        $user->position_preference = $position;
        $user->save();
        return redirect()->back();
    }

    public function subscriptionRegister()
    {
        return view('user.subscription_register');
    }

    public function multilevelTree()
    {
        $multilevel = new Multilevel(Auth::user());

        return view('user.tree', compact('multilevel'));
    }

    public function ranksList()
    {
        $ranks = Rank::all();
        $rankUser = Auth::user()->rank;
        $multilevel = new Multilevel(Auth::user());
        return view('user.ranks', compact('ranks', 'rankUser', 'multilevel'));
    }

    public function addBonusRetained($user_id)
    {
        try {
            DB::beginTransaction();
            $timeForDelivery = System::where('parameter', 'time_months_delivery')->first()->value;
            $multiplier = System::where('parameter', 'multiplier_retained_bonus')->first()->value;
            $today = Carbon::today()->format('Y-m-d');
            // se obtiene el monto retenido con fecha superior
            $bonusRetaineds = UserBonusRetained::where('users_id', $user_id)->get();
            foreach ($bonusRetaineds as $retained) {

                $dateCreated = new Carbon($retained->created_at);
                // se agregan meses configurados a la fecha de creacion de retencion
                $dateRetained = $dateCreated->addMonths($timeForDelivery)->format('Y-m-d');

                // para agregar el valor retenido debe ser mayor la fecha actual
                if ($today >= $dateRetained) {
                    $balance = new UserBalance();
                    $balance->users_id = $retained->users_id;
                    // se agrega el valor retenido * multiplicador de inversion
                    $balance->amount = ($retained->amount * $multiplier);
                    $balance->type = "reintegrate_bonus";
                    $balance->created_user = $retained->users_id;
                    if ($balance->save()) {
                        $retained->delete();
                    }
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }

    public function upgradePoolMembership(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "support_document" => "required|mimes:jpg,jpeg,png,pdf"
        ]);
        if ($validator->fails()) {
            Alert::warning('Error', 'Agregue extension de Documento Aceptado');
            return redirect()->back();
        } else {
            $file = $request->file('support_document');

            $verification = new MembershipPoolUpgrades();
            $verification->fill($request->all());
            $verification->users_id = Auth::user()->id;
            $verification->support_document = $file->getClientOriginalName();

            if ($verification->save()) {
                $request->support_document->storeAs('users/' . Auth::user()->id . '/memberships_pool_upgrades/', $verification->id . '.' . $file->getClientOriginalExtension());
                Alert::success('', 'Registro exitoso');
                return redirect()->back();
            }
        }
    }

    public function generalDownloads($id, $table, $type = null)
    {
        $path = null;
        $name = null;
        if ($table == 'm_pool_upgrades') {
            $data = MembershipPoolUpgrades::find($id);
            $user_id = $data->users_id;
            $path = 'users/' . $user_id . '/memberships_pool_upgrades/' . $data->id . '.' . File::extension($data->support_document);
            $name = $data->support_document;
        }

        if ($type == 1) {
            // visualizacion
            return Storage::exists($path) ? Storage::response($path) : null;
        } else {
            // descarga
            if (Storage::exists($path))
                return Storage::download($path, $name);
            else {
                Alert::error('', __('Archivo no encontrado'));
                return redirect()->back();
            }
        }
    }

    public function loadVerificationCoinbase(Request $request)
    {
        $registration = System::where('parameter', 'registration_value')->first();
        $kyc_for_buy = System::where('parameter', 'kyc_for_buy')->first();

        if ($kyc_for_buy->value) {
            $validateKyc = Auth::user()->hasValidKyc();
        } else {
            $validateKyc = true;
        }

        if ($validateKyc) {

            $membership = Membership::find($request->user_membresia_id);
            if ($membership) {
                $userMembership = UserMembership::where('users_id', Auth::id())->first();

                if (!$userMembership || $membership->type != $userMembership->membership->type) {
                    $userMembership = new UserMembership();
                    $userMembership->users_id = Auth::id();
                    $userMembership->memberships_id = $membership->id;
                    $userMembership->price = $membership->amount;
                    $userMembership->save();
                }


                $system = System::where('parameter', 'registration_value')->first();
                $coinbaseAPIKey = env('COINBASE_COMMERCE_API_KEY');
                $amount = $membership->amount;
                $tipo_cuenta = 'BTC';
                $identification_document = $request->input('identification_document');
                $cellphone = $request->input('cellphone');
                $code_phone = $request->input('code_phone');
                $cellphone_code = "+" . $code_phone;
                $client = ApiClient::init($coinbaseAPIKey);
                $client->setTimeout(3000);
                $chargeObj = new Charge();
                $chargeObj->name = Auth::user()->username;
                $chargeObj->description = 'Pago de Membresía';

                $membershipActive = Auth::user()->membershipActive;

                if ($membershipActive) {
                    $valor = ($membership->amount - $userMembership->membership->amount) + $system->value;
                } else {
                    $valor = $membership->amount + $system->value;
                }

                $chargeObj->local_price = [
                    'amount' => $valor,
                    'currency' => 'USD'
                ];

                $chargeObj->pricing_type = 'fixed_price';
                $serial = md5(Auth::id() . date('YmdHis'));
                $chargeObj->redirect_url = route('CoinbaseSuccess', $serial);
                $chargeObj->cancel_url = route('CoinbaseCancel', $serial);
                $chargeObj->save();

                $user = Auth::user();
                $multilevel = new Multilevel($user);
                $rank = $multilevel->rank();
                $user->ranks_id = $rank;
                $user->save();

                if (isset($chargeObj->id) && $chargeObj->id) {
                    $coinbase = PaymentCoinbase::where('users_id', Auth::id())->where('user_memberships_id', $userMembership->id)->where('status', 'P')->first();

                    if ($coinbase) {
                        $coinbase->users_id = Auth::id();
                        $coinbase->serial = $serial;
                        $coinbase->memberships_id = $request->user_membresia_id;
                        $coinbase->transaction_id = $chargeObj->id;
                        $coinbase->amount = $amount;
                        $coinbase->user_memberships_id = $userMembership->id;
                        $coinbase->identification_document = $identification_document;
                        $coinbase->code_zone = $cellphone_code;
                        $coinbase->cellphone = $cellphone;
                        $coinbase->save();
                    } else {
                        $coinbase = new PaymentCoinbase();
                        $coinbase->users_id = Auth::id();
                        $coinbase->memberships_id = $request->user_membresia_id;
                        $coinbase->serial = $serial;
                        $coinbase->transaction_id = $chargeObj->id;
                        $coinbase->amount = $amount;
                        $coinbase->user_memberships_id = $userMembership->id;
                        $coinbase->identification_document = $identification_document;
                        $coinbase->code_zone = $cellphone_code;
                        $coinbase->cellphone = $cellphone;
                        $coinbase->save();
                    }
                    if ($coinbase) {
                        $contact = UserContactInformation::firstOrNew(["users_id" => Auth::id()]);
                        $contact->identification_document = $request->input('identification_document');
                        $contact->cellphone1 = $cellphone;
                        $contact->save();
                    }
                    return redirect($chargeObj->hosted_url);
                }
            }
        } else {
            Alert::warning(__('KYC'), __('Para poder realizar la solicitud de activación de la membresía debe cumplir con todos los documentos del KYC'))->persistent(true);
            return redirect()->route('user.kyc');
        }
        return redirect()->back();

    }

    public function CoinbaseSuccess($serial)
    {
        DB::beginTransaction();
        try {


            // Pago aceptado
            $coinbase = PaymentCoinbase::where('serial', $serial)->where('status', "P")->first();

            if ($coinbase) {
                //Verificamos si el usuario ya tenia una membresia
                $previousMembership = $coinbase->user->membershipActive;
                $coinbase->status = "V";//Verificado
                if ($coinbase->save()) {

                    if ($previousMembership) {
                        $previousMembership->expiration_description = "Se elimina a raiz de un upgrade";
                        $previousMembership->save();
                        $previousMembership->delete();

                        $userMembership = new UserMembership();
                        $userMembership->users_id = $coinbase->users_id;
                        $userMembership->price = $coinbase->amount;
                        $userMembership->memberships_id = $coinbase->memberships_id;
                        $userMembership->status = 'A';
                        $userMembership->expiration_date = now()->format('Y-m-d H:i:s');

                        $user = User::where('id', Auth::id())->first();
                        $user->has_vip = 0;
                        $user->save();
                    } else {
                        $userMembership = UserMembership::where('id', $coinbase->user_memberships_id)->first();
                        $userMembership->status = 'A';
                        $userMembership->expiration_date = now()->format('Y-m-d H:i:s');
                    }

                    if ($userMembership->save()) {
                        //Se verifica que se este activando una membresia y que no exista una membresia ya activa
                        if ($userMembership->membership->type == 'membership' && !$previousMembership) {

                            $bonusMethods = new BonusMethods($userMembership);
                            $bonusMethods->execute('quick_start');
                            $membershipController = new MembershipController();
                            if ($membershipController->enrollMultilevel($userMembership->user)) {
                                //Se ajusta el score de los nodos superiores al usuario que acaba de activar el binario
                                $multilevel = new Multilevel($userMembership->user);
                                foreach ($multilevel->upper(100) as $position) {
                                    // dd($position);
                                    if ($position) {
                                        $userScore = new UserScore();
                                        $userScore->amount = $userMembership->price;
                                        $userScore->users_id = $position->users_id;
                                        $userScore->side = $userMembership->user->userMultilevel->position;
                                        $userScore->created_user = Auth::id();
                                        $userScore->save();
                                    }
                                }
                            }

                            Alert::success(__('Aprobado'), __('Se ha realizado la aprobación de la solicitud y activación de la membresías'));
                        } elseif ($userMembership->membership->type == 'subscription') {
                            Alert::success(__('Aprobado'), __('Se ha realizado la aprobación de la solicitud y activación de la suscripción'));
                            $bonusMethods = new BonusMethods($userMembership);
                            $bonusMethods->quick_start_subscription();
                        }
                        DB::commit();
                        return view('user.coinbaseSuccess');
                    }
                }
            }
            DB::rollBack();
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollBack();
        }
    }

    public function CoinbaseCancel($serial)
    {
        //echo 'Pago cancelado';
        $coinbase = PaymentCoinbase::where('serial', $serial)->where('status', "P")->first();
        //dd($coinbase);
        if ($coinbase) {
            $coinbase->status = "C";//Cancelado
            if ($coinbase->save()) {
                $usermebership = UserMembership::where('id', $coinbase->user_memberships_id)->first();
                return view('user.coinbaseCancel');
            }
        }
    }

    public
    function retrieve($charge_id)
    {
        $client = ApiClient::init(env('COINBASE_COMMERCE_API_KEY'));
        $client->setTimeout(3);
        $chargeObj = Charge::retrieve($charge_id);

        return $chargeObj;
    }

    public
    function recheck($id, $redirect = true)
    {
        $data = PaymentCoinbase::where('user_memberships_id', $id)->where('status', "P")->get()->last();
        //  dd($data);
        if ($data) {
            $retrieve = $this->retrieve($data->transaction_id);
            $last = collect($retrieve->timeline)->last();
            //dd($last);
            if ($last['status'] == 'COMPLETED') {
                $data->status = "V";//Verificado
                if ($data->save()) {
                    $usermebership = $data->usermebership;
                    $usermebership->status = 'A';
                    if ($redirect) {
                        Alert::success('Pago verificado', 'Se encontro y actualizo un registro pendiente que ya habia sido confirmado en coinbase')->persistent();
                        return redirect()->back();
                    }
                }
            }
        }
        if ($redirect) {
            Alert::success('Pago', 'No se encontro ninguna accion pendiente por ejecutar')->persistent('Ok');
            return redirect()->back();
        }
    }

    public
    function closeAccount()
    {
        $membership = Auth::user()->membership;
        if ($membership) {
            Mail::to('santiago131@gmail.com')->send(new CloseAccountMail($membership));
            $membership->expiration_date = date('Y-m-d H:i:s');
            $membership->expiration_description = 'Cancelacion de la cuenta por el usuario';
            $membership->delete();
            return redirect()->route('dashboard');
        }
    }

    public
    function bonusRetained()
    {
        return view('user.bonus_retained');
    }

    public
    function bonusRetained_ajax(Request $request)
    {
        if ($request->ajax()) {

            $query = UserBonusRetained::query()->where('users_id', Auth::user()->id)->orderByDesc('created_at')->withTrashed();
            //  dd($query);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => e($row->created_at->format('d/m/Y H:i:s')),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
//                ->filterColumn('created_at', function ($query, $keyword) {
//                    $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
//                })
                ->addColumn('type', function ($row) {
                    return $row->UserBalance ? $row->UserBalance->type : '';
                })
                ->addColumn('total', function ($row) {
                    return '$' . $row->total;
                })
//                ->addColumn('delivered_value', function ($row) { //valor entregado
//                    $value = $row->UserBalance ? $row->UserBalance->amount : null;
//                    return '<span class="badge badge-success">$' . $value . '</span>';
//                })
                ->addColumn('percentage_balance', function ($row) {
                    return '%' . $row->percentage_balance;
                })
//                ->addColumn('percentage_retained', function ($row) {
//                    return '%' . $row->percentage_retained;
//                })
//                ->addColumn('retained_value', function ($row) { //valor retenido
//                    return '<span class="badge badge-danger">- $' . $row->amount . '</span>';
//                })
//                ->addColumn('date_delivery', function ($row) { //Fecha de entrega
//                    return $row->dateDelivery();
//                })
//                ->addColumn('status_delivery', function ($row) {
//                    // Si el registro esta eliminado es porque se entrego el bono
//                    if ($row->deleted_at) {
//                        $status = "<span class='badge badge-success'>Entregado</span>";
//                    } else {
//                        $status = "<span class='badge badge-warning'>Pendiente</span>";
//                    }
//                    return $status;
//                })
                //   ->rawColumns(['status_delivery', 'retained_value', 'delivered_value'])
                ->make(true);
        }
    }

    public function loadMercadoPago(Request $request)
    {
        $registration = System::where('parameter', 'registration_value')->first();
        $kyc_for_buy = System::where('parameter', 'kyc_for_buy')->first();
        if ($kyc_for_buy->value) {
            $validateKyc = Auth::user()->hasValidKyc();
        } else {
            $validateKyc = true;
        }
        // $name =$request->name;
        //$email =$request->email;
        $identification_document = $request->input('identification_document');
        $cellphone = $request->input('cellphone');

        if ($validateKyc) {
            $membership = Membership::find($request->user_membresia_id);
            if ($membership) {
                $userMembership = UserMembership::where('users_id', Auth::id())->where('type', $membership->type)->first();
                if (!isset($userMembership)) {
                    $userMembership = new UserMembership();
                    $userMembership->users_id = Auth::id();
                    $userMembership->memberships_id = $membership->id;
                    $userMembership->price = $membership->amount + (int)$registration->value;
                    $userMembership->save();
                }
                $user_membresia_id = Auth::user()->userMembership->id;
                $accesesToken = env('MERCADO_PAGO_TOKEN');
                // Agrega credenciales
                MercadoPago\SDK::setAccessToken($accesesToken);
                // Crea un objeto de preferencia
                $preference = new MercadoPago\Preference();
                // Crea un ítem en la preferencia
                $item = new MercadoPago\Item();
                $item->title = 'Pago de Membresia';
                $item->description = 'Pago de Membresia';
                $item->quantity = 1;
                $item->unit_price = $userMembership->price + (int)$registration->value;
                $item->currency_id = "USD";

                $preference->items = array($item);
                $serial = md5(Auth::id() . date('YmdHis'));
                $preference->back_urls = array(
                    "success" => route('MercadoPagoSuccess', $serial),
                    "failure" => route('MercadoPagofailure', $serial),
                    "pending" => route('MercadoPagofailure', $serial)//"http://localhost:8080/feedback"
                );
                $preference->auto_return = "approved";

                //Se comenta por que no se requiere datos del pagador en el sistema.
                /*$payer = new MercadoPago\Payer();
                $payer->name = $name;
                $payer->email = $email;
                $preference->payer = $payer;*/
                $preference->save();

                if ($preference) {
                    // se guarda el pago en la BD en espera de las notificaciones por IPN
                    $paymentMercadoPago = PaymentMercadoPago::where('users_id', Auth::id())->where('user_memberships_id', $user_membresia_id)->where('status', 'P')->first();
                    if ($paymentMercadoPago) {
                        $paymentMercadoPago->users_id = Auth::id();
                        $paymentMercadoPago->serial = $serial;
                        $paymentMercadoPago->external_reference = $preference->id;
                        $paymentMercadoPago->amount = $item->unit_price;
                        //$paymentMercadoPago->name = !empty($name) ? $name : '';
                        //$paymentMercadoPago->email = $email;
                        $paymentMercadoPago->status = 'P';
                        $paymentMercadoPago->user_memberships_id = $user_membresia_id;
                        $paymentMercadoPago->identification_document = $identification_document;
                        $paymentMercadoPago->cellphone = $cellphone;
                        $paymentMercadoPago->save();
                    } else {

                        $paymentMercadoPago = new PaymentMercadoPago;
                        $paymentMercadoPago->users_id = Auth::id();
                        $paymentMercadoPago->serial = $serial;
                        $paymentMercadoPago->external_reference = $preference->id;
                        $paymentMercadoPago->amount = $item->unit_price;
                        // $paymentMercadoPago->name = !empty($name) ? $name : '';
                        //$paymentMercadoPago->email = $email;
                        $paymentMercadoPago->status = 'P';
                        $paymentMercadoPago->user_memberships_id = $user_membresia_id;
                        $paymentMercadoPago->identification_document = $identification_document;
                        $paymentMercadoPago->cellphone = $cellphone;
                        $paymentMercadoPago->save();
                    }
                }
                // dd($preference);
                if ($paymentMercadoPago) {
                    $contact = UserContactInformation::firstOrNew(["users_id" => Auth::id()]);
                    $contact->identification_document = $request->input('identification_document');
                    $contact->cellphone1 = $request->input('cellphone');
                    $contact->save();
                }

                return redirect($preference->init_point);

                //Se comenta para no abrir en mercado pago en modal
                // return view('user.MercadoPagoCheckout')->with('preference',$preference);
            }

        } else {
            Alert::warning(__('KYC'), __('Para poder realizar la solicitud de activación de la membresía debe cumplir con todos los documentos del KYC'))->persistent(true);
            return redirect()->route('user.kyc');
        }
        return redirect()->back();

    }

    public
    function MercadoPagoSuccess($serial)
    {
        // Pago aceptado
        $MercadoPago = PaymentMercadoPago::where('serial', $serial)->where('status', "P")->first();

        if ($MercadoPago) {
            $MercadoPago->status = "V";//Verificado
            if ($MercadoPago->save()) {
                $usermebership = UserMembership::where('id', $MercadoPago->user_memberships_id)->first();
                $usermebership->status = 'A';
                $usermebership->save();

                $coinbase = PaymentCoinbase::where('users_id', Auth::id())->where('user_memberships_id', $usermebership->id)->where('status', 'P')->first();
                if ($coinbase) {
                    $coinbase->status = "C";//Verificado
                    $coinbase->save();
                }
                return view('user.MercadoPagoSuccess');
            }
        }
    }

    public
    function MercadoPagofailure($serial)
    {
        // 'Pago cancelado';
        $MercadoPago = PaymentMercadoPago::where('serial', $serial)->where('status', "P")->first();
        //dd($coinbase);
        if ($MercadoPago) {
            $MercadoPago->status = "C";//Cancelado
            if ($MercadoPago->save()) {
                $usermebership = UserMembership::where('id', $MercadoPago->user_memberships_id)->first();
                return view('user.MercadoPagofailure');
            }
        }

    }

    function CancelPlan($user_id, $memberships_id)
    {
        // dd($memberships_id);
        $coinbase = PaymentCoinbase::where('users_id', $user_id)->where('memberships_id', $memberships_id)->where('status', "P")->first();
        // dd($coinbase);
        if ($coinbase) {
            $coinbase->status = "C";//Cancelado
            if ($coinbase->save()) {
                // return view('user.coinbaseCancel');
                Alert::success(__('Cancelado'), __('Se cancelo upgrade con exito'));
                return redirect()->back();
            }
        }
    }

}
