<?php

namespace App\Http\Controllers;

use App\Http\Requests\changedPasswordRequest;
use App\Models\Country;
use App\Models\UserContactInformation;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = User::find(\Auth::id());
        $countries = Country::query()->pluck('name', 'id');

        return view('cruds.profile.edit', compact('user', 'countries'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'file_upload' => 'image',
            'birth_date' => 'date',
        ]);

        $user = Auth::user();
        $user->fill($request->all());
        $user->save();

        $contact = UserContactInformation::firstOrNew(["users_id" => Auth::id()]);
        if ($request->file("file_upload")) {
            $name_image = str_replace(' ', '_', $request->file('file_upload')->getClientOriginalName());
            $pathFile = 'profiles/users_id_' . $id . '_' . $name_image;
            \Storage::disk('public')->put($pathFile, \File::get($request->file('file_upload')));
            if (\Storage::disk('public')->exists($pathFile))
                $url_image = \Storage::url($pathFile);

            $contact->name_image = $name_image;
            $contact->url_image = $url_image;
        }
        $contact->fill($request->all());
        $contact->users_id = Auth::id();
        $contact->save();

        Alert::success('', __('Informacion actualizada correctamente'));
        return redirect()->route('profile.edit', 'user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param changedPasswordRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userChangedPassword(changedPasswordRequest $request, User $user)
    {
        $input = $request->except('_method', '_token');

        if (!Hash::check($input['current_password'], $user->password)) {
            Alert::warning('', __('La contraseña no coincide'));
            return redirect()->back();
        } elseif (Hash::check($input['current_password'], $user->password)) {
            if ($input['password'] == $input['password_confirmation']) {
                $user->forceFill([
                    'password' => Hash::make($input['password']),
                ])->save();

                Alert::success('', __('Contraseña actualizada correctamente'));
                return redirect()->back();
            } else {
                Alert::warning('', __('La contraseña no coincide'));
                return redirect()->back();
            }
        }
    }


}
