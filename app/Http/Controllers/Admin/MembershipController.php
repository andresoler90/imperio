<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Libs\BonusMethods;
use App\Http\Controllers\Libs\Multilevel;
use App\Models\Bonus;
use App\Models\Membership;
use App\Models\MembershipVerifications;
use App\Models\UserBonus;
use App\Models\UserMembership;
use App\Models\UserMultilevel;
use App\Models\UserScore;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MembershipController extends Controller
{
    public function index()
    {
        $usermemberships = UserMembership::join('memberships', 'memberships.id', 'user_memberships.memberships_id')
            ->where('memberships.type', 'membership')
            ->select('user_memberships.*')->get();

        return view('cruds.membership.index', compact('usermemberships'));
    }

    public function downloadDocument(MembershipVerifications $membershipVerifications, $type = null)
    {
        $user = $membershipVerifications->userMembership->user;
        if ($type == 1) {
            // visualizacion
            $path = 'users/' . $user->id . '/memberships_verifications/' . $membershipVerifications->id . '.' . File::extension($membershipVerifications->support_document);
            return Storage::exists($path) ? Storage::response($path) : null;
        } else {
            // descarga por usuario

            $path = 'users/' . $user->id . '/memberships_verifications/' . $membershipVerifications->id . '.' . File::extension($membershipVerifications->support_document);
            if (Storage::exists($path))
                return Storage::download($path, $membershipVerifications->support_document);
            else {
                Alert::error('', __('Archivo no encontrado'));
                return redirect()->back();
            }
        }
    }

    public function verificationConfirm(Request $request)
    {

        $validated = $request->validate([
            "membership_verification_id" => "required",
        ]);

        $mVerification = MembershipVerifications::find($request->membership_verification_id);
        $mVerification->fill($request->all());
        $mVerification->confirm_user = Auth::id();
        $mVerification->save();

        if ($mVerification->status == 'A') {
            $userMembership = UserMembership::find($mVerification->user_memberships_id);
            $userMembership->status = 'A';
            if ($userMembership->save()) {
                foreach ($request->bonus as $key => $bonusData) {
                    $bonus = Bonus::find($bonusData);
                    $userBonus = UserBonus::firstOrNew([
                        'bonus_id' => $bonus->id,
                        'users_id' => $userMembership->users_id
                    ]);
                    $userBonus->users_id = $userMembership->users_id;
                    $userBonus->user_memberships_id = $userMembership->id;
                    $userBonus->bonus_id = $bonus->id;
                    $userBonus->percentage = $request->bonus_percentage[$key];
                    $userBonus->created_user = Auth::id();
                    $userBonus->save();
                }

                $bonusMethods = new BonusMethods($userMembership);
                $bonusMethods->execute('quick_start');

                if ($this->enrollMultilevel($userMembership->user)) {
                    //Se ajusta el score de los nodos superiores al usuario que acaba de activar el binario
                    $multilevel = new Multilevel($userMembership->user);
                    foreach ($multilevel->upper(100) as $position) {
                        if ($position) {
                            $userScore = new UserScore();
                            $userScore->amount = $userMembership->price;
                            $userScore->users_id = $position->users_id;
                            $userScore->side = $userMembership->user->userMultilevel->position;
                            $userScore->created_user = Auth::id();
                            $userScore->save();
                        }
                    }

                    Alert::success('Aprobado', 'Se ha realizado la aprobacion de la solicitud y activacion de la membresia');
                }
            }
        }

        return redirect()->back();
    }


    public function detail(UserMembership $userMembership)
    {
        $membership = $userMembership->membership;
        $user = $userMembership->user;
        $bonus = Bonus::all();
        return view('cruds.membership.detail', compact('userMembership', 'user', 'membership', 'bonus'));
    }

    /**
     * Lista todas las membresias/productos del sistema
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $memberships = Membership::all();
        return view('cruds.membership.list', compact('memberships'));
    }

    /**
     * Carga la vista de edicion de una membresia
     * @param Membership $membership
     */
    public function edit(Membership $membership)
    {
        return view('cruds.membership.edit', compact('membership'));
    }

    public function create()
    {
        return view('cruds.membership.create');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "amount" => "required",
            "cap" => "required",
            "image" => "image",
        ]);

        $membership = Membership::find($request->id);
        $membership->fill($request->all());
        if (isset($request->image)) {
            $image = $request->file('image');
            $name = substr(md5(date('dmYHis')), 0, 10) . '.' . $image->getClientOriginalExtension();
            $membership->image = $name;
        }
        if ($membership->save()) {
            if (isset($request->image)) {
                $image->storeAs('public/memberships/', $name);
            }
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "amount" => "required",
            "cap" => "required",
            "image" => "image",
        ]);

        $membership = new Membership();
        $membership->fill($request->all());
        if (isset($request->image)) {
            $image = $request->file('image');
            $name = substr(md5(date('dmYHis')), 0, 10) . '.' . $image->getClientOriginalExtension();
            $membership->image = $name;
        }
        if ($membership->save()) {
            if (isset($request->image)) {
                $image->storeAs('public/memberships/', $name);
            }
            return redirect()->route('membership.list');
        }
    }

    public function enrollMultilevel(User $user)
    {
        $sponsor = User::find($user->sponsor_id);

        $multilevel = new Multilevel($sponsor);
        $newNode = $multilevel->nextEmpty($sponsor->position_preference);

        $userMultilevel = UserMultilevel::where('users_id', $user->id)->first();
        if (!$userMultilevel) {
            $userMultilevel = new UserMultilevel();
            $userMultilevel->users_id = $user->id;
            $userMultilevel->parent_users_id = $newNode->parent_users_id;
            $userMultilevel->position = $newNode->position;
            if ($userMultilevel->save()) {
                return true;
            }
        }
        return false;
    }
}
