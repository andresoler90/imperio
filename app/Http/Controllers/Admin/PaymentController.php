<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\UserBalance;
use App\Models\UserPaymentRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = UserPaymentRequest::orderby('created_at', 'desc')->paginate(15);


        return view('cruds.payment.index', compact('payments'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            UserPaymentRequest::find($id)->delete();
            \DB::commit();

            \Alert::success('', __('Pago eliminado correctamente'));
            return redirect()->back();

        } catch (\Exception $exception) {
            \DB::rollBack();
            dd($exception->getMessage());
        }

    }

    public function searchByFilter(Request $request)
    {

        $payments = UserPaymentRequest::select('user_payment_requests.*', 'users.name')->join('users', 'users.id', '=', 'user_payment_requests.users_id')
            ->where('type', $request->type)->where('status', $request->status)->orderby('user_payment_requests.created_at', 'desc');

        if ($request->name != '') {
            $payments = $payments->where('name', 'like', '%' . $request->name . '%');
        }

        $payments = $payments->get();

        return view('cruds.payment.filters', compact('payments'))->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actionForm(Request $request)
    {
        if ($request->refuse) {
            $this->refuse($request, $request->legacy);
        } elseif ($request->approve) {
            $this->approve($request, $request->legacy);
        }
        return redirect()->route('payment.index');
    }

    /**
     * @param $request
     */
    public function approve($request)
    {
        try {
            if ($request->payments) {
                foreach ($request->payments as $id => $check) {
                    $paymentUser = UserPaymentRequest::find($id);

                    //Solo se aprueban solicitudes pendientes
                    if ($paymentUser->status == 0) {
                        \DB::beginTransaction();

                        $paymentUser->status = 1;
                        $paymentUser->save();

                        // Pago ejecutado por admin

                        $paymenAdmin = new Payments();
                        $paymenAdmin->users_id = \Auth::id(); //Usuario modificador
                        $paymenAdmin->user_payment_id = $id;
                        $paymenAdmin->save();

                        // Se modifica balance de usuario

                        $userBalances = new UserBalance();
                        $userBalances->users_id = $paymentUser->users_id;
                        $userBalances->amount = -$paymentUser->amount_remove;
                        $userBalances->type = 'payment';
                        $userBalances->created_user = \Auth::id();//Usuario modificador
                        $userBalances->save();

                        // Se le cobra la comision al usuario
                        $commission = new UserBalance();
                        $commission->users_id = $paymentUser->users_id;
                        $commission->amount = -$paymentUser->remove_commission;
                        $commission->type = 'remove_commission';
                        $commission->created_user = \Auth::id();//Usuario modificador
                        $commission->save();

                        \DB::commit();
                    }
                }
                \Alert::success('', __('Proceso de aprobación realizado correctamente'));
            } else {
                \Alert::warning('', __('Seleccione por lo menos 1 registro'));
            }
        } catch (\Exception $exception) {
            \DB::rollBack();
            dd($exception->getMessage());
        }

    }

    /**
     * @param $request
     */
    public function refuse($request)
    {
        try {
            if ($request->payments) {
                foreach ($request->payments as $id => $check) {
                    //Usuario que solicita pago

                    $paymentUser = UserPaymentRequest::find($id);
                    //Solo se aprueban solicitudes pendientes
                    if ($paymentUser->status == 0) {
                        \DB::beginTransaction();

                        $user = $paymentUser->users_id;
                        $amount_remove = $paymentUser->amount_remove;
                        $paymentUser->status = 2;
                        $paymentUser->save();

                        // Pago ejecutado por admin

                        $paymenAdmin = new Payments();
                        $paymenAdmin->users_id = \Auth::id(); //Usuario modificador
                        $paymenAdmin->user_payment_id = $id;
                        $paymenAdmin->save();

                        \DB::commit();
                    }
                }
                \Alert::success('', __('Proceso de rechazo realizado correctamente'));
            } else {
                \Alert::warning('', __('Seleccione por lo menos 1 registro'));
            }
        } catch (\Exception $exception) {
            \DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
