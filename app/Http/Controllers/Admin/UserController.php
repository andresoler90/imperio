<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Controller;
use App\Mail\Users\ResetPasswordMail;
use App\Models\KycType;
use App\Models\LegacyBalance;
use App\Models\Membership;
use App\Models\MembershipPoolUpgrades;
use App\Models\Product;
use App\Models\Role;
use App\Models\UserBalance;
use App\Models\UserMembership;
use App\Models\UserProduct;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Libs\Multilevel;
use App\Models\UserMultilevel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc("created_at")->get();

        return view('cruds.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('cruds.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            "name"  => "required|min:3|string",
            "email" => "required|email|unique:users,email"
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt('123456');
        $user->created_user = Auth::id();
        if ($user->save()) {
            Alert::success('', 'Registro exitoso');
        }

        return redirect()->route('user.edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('cruds.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        $listMemberships = Membership::all()->pluck("name", "id");
        $products = Product::all()->pluck('name', 'id');
        $typesKyc = KycType::all();
        $users = User::all()->pluck("username", "id");
        $userMembership = UserMembership::where("users_id", $user->id)->first();
        return view('cruds.users.edit', compact('user', 'roles', 'listMemberships', 'products', 'typesKyc', 'userMembership', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "name" => "required|min:3|string",
        ]);
        $user->fill($request->all());
        if ($user->save()) {
            Alert::success("Actualizado");
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('message', 'item deleted successfully');
    }

    public function productByUser(Request $request)
    {
        $validated = $request->validate([
            "products_id" => "required"
        ]);

        $carbon = new Carbon();
        $product = Product::find($request->products_id);
        $userProduct = new UserProduct();
        $userProduct->users_id = $request->users_id;
        $userProduct->products_id = $product->id;
        $userProduct->price = $product->price;
        $userProduct->created_user = Auth::id();
        $userProduct->expiration_date = $carbon->addDays($product->expiration_days);
        $userProduct->save();
        if ($userProduct->save()) {
            Alert::success('', 'Registro exitoso');
        }

        return redirect()->route('user.edit', $request->users_id);
    }

    public function addBalance(Request $request)
    {
        $newBalance = new UserBalance();
        $newBalance->users_id = $request->users_id;
        $newBalance->amount = $request->amount;
        $newBalance->type = "payment";
        $newBalance->created_user = Auth::id();
        if ($newBalance->save()) {
            Alert::success('', __('Saldo actualizado'));
        }
        return redirect()->back();
    }

    public function addBalanceLegacy(Request $request)
    {
        $newBalance = new LegacyBalance();
        $newBalance->users_id = $request->users_id;
        $newBalance->amount = $request->amount;
        $newBalance->type = "payment";
        $newBalance->created_user = Auth::id();
        if ($newBalance->save()) {
            Alert::success('', __('Saldo antiguo actualizado'));
        }
        return redirect()->back();
    }


    public function assignMembership(Request $request)
    {

        $membership = Membership::find($request->memberships_id);
        $userMembership = UserMembership::firstOrNew(["users_id" => $request->users_id]);
        $userMembership->users_id = $request->users_id;
        $userMembership->memberships_id = $membership->id;
        $userMembership->price = $membership->amount;
        $userMembership->status = 'A';
        $userMembership->save();
        // Validamos que el usuario no esté en la tabla multi nivel
        if($this->validUserMultiLevel($request->users_id)){
            $user = User::where("id", $request->users_id)->first();
            $membershipController = new MembershipController();
            $membershipController->enrollMultilevel($user);
        }
        Alert::success('', __('Membresía actualizada'));
        return redirect()->back();
    }

    public function validUserMultiLevel(int $id): bool
    {
       $multi = UserMultilevel::where('users_id',$id )->first();
       if($multi){
           return false;
       }
       return true;
    }


    public function ajaxList(Request $request)
    {
        if ($request->ajax()) {

            return DataTables::of(User::query())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editLink = "<a href='" . route('user.edit', $row->id) . "' class='btn btn-sm btn-ghost-dark'><i class='fa fa-edit'></i></a>";
                    return $editLink;
                })
                ->addColumn('created_at', function ($row) {
                    return date("d/m/Y H:i:s", strtotime($row->created_at));
                })
                ->addColumn('role', function ($row) {
                    return $row->role ? $row->role->name : '';
                })
                ->addColumn('sponsor', function ($row) {
                    return $row->sponsor ? $row->sponsor->username : '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function deactivateA2fa(User $user)
    {
        $user->token_login = null;
        if ($user->save()) {
            Alert::success("Autenticación de doble factor", "Desactivado");
            return redirect()->back();
        }
    }

    public function resetPassword(User $user)
    {
//        $password = strtoupper(substr(md5(date("dmYHis")), 0, 10));
//        $user->password = bcrypt($password);
//        if ($user->save()) {
//            Mail::to($user->email)->send(new ResetPasswordMail($user, $password));
//            Alert::success("Correo", "Se ha enviado un correo con la informacion de la contraseña");
//            return redirect()->back();
//        }

        $newpassword = URL::temporarySignedRoute(
            'newPassword',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->id,
            ]
        );

        Mail::to($user->email)->send(new ResetPasswordMail($user, $newpassword));
        Alert::success("Correo", "Se ha enviado un correo para recuperar la contraseña");
        return redirect()->route('login');
        // }
    }

    public function resetclavenew(Request $request)
    {
        $id = $request->input('userd_id');
        if ($id) {
            $input = $request->except('_method', '_token');
            $reset_clave = User::where('id', $id)->first();
            if (!empty($reset_clave)) {
                if ($input['new_password'] == $input['confir_password']) {
                    $reset_clave->forceFill([
                        'password' => Hash::make($input['new_password']),
                    ])->save();
                    Alert::success('', __('Contraseña actualizada correctamente'));
                    return redirect()->route('login');
                } else {
                    Alert::warning('', __('La contraseña no coincide'));
                    return redirect()->back();
                }
            }
        }
    }

    public function listPoolUpgrade()
    {
        $listPoolUpgrades = MembershipPoolUpgrades::orderBy('created_at', 'desc')->paginate(10);
        return view('cruds.membership.listPoolUpgrade', compact('listPoolUpgrades'));

    }

    public function approvedPoolUpgrade(MembershipPoolUpgrades $pool, $status)
    {
        if ($pool) {
            $pool->status = $status;
            $pool->confirm_user = Auth::id();
            if ($pool->save()) {
                if ($status == 'A') {
                    $membership = $pool->user->membership;
                    if ($pool->memberships_id > $membership->memberships_id) {
                        $membership->memberships_id = $pool->memberships_id;
                        $membership->save();
                    }
                }
            }
            Alert::success('', __('Estado actualizado'));
        }
        return redirect()->back();
    }

    public function destroyPoolUpgrade(MembershipPoolUpgrades $pool)
    {
        if ($pool) {
            $pool->delete();
            $pool->confirm_user = Auth::id();
            Alert::success('', __('Registro eliminado'));
        }
        return redirect()->back();
    }

    public function hasVip($val, User $user)
    {
        $user->has_vip = $val;
        if ($user->save()) {
            Alert::success('VIP', 'Los datos han sido actualizados');
            return redirect()->back();
        }
    }

    public function changedPassword(Request $request)
    {
        if ($request->users_id) {
            $reset_clave = User::find($request->users_id);
            if ($reset_clave) {
                if ($request->new_password) {
                    $reset_clave->forceFill([
                        'password' => Hash::make($request->new_password),
                    ])->save();
                    Alert::success('', __('Contraseña actualizada correctamente'));
                    return redirect()->back();
                } else {
                    Alert::warning('', __('Debe ingresar contraseña'));
                    return redirect()->back();
                }
            }
        }
    }

    public function destroy_user(Request $request)
    {
        $user = User::find($request->users_id);
        if ($user) {

            $user->delete();
            Alert::success('Usuarios', 'El usuario ha sido eliminado');
            return redirect()->route('user.index');
        } else {
            Alert::warning('Usuario', 'El usuario no existe');
        }

        return redirect()->back();
    }

}
