<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::paginate(10);
        return view('cruds.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('cruds.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            "name" => "required|min:3|max:100",
        ]);

        $role = new Role();
        $role->fill($request->all());
        if ($role->save()) {
            Alert::success('', 'Registro exitoso');
            return redirect()->route('roles.edit', $role->id);
        }
    }

    public function edit(Role $role)
    {
        $data = $role;
        $roles = Role::all()->pluck('name', 'id');
        return view('cruds.roles.edit', compact('roles', 'data'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $this->validate($request, [
            "name" => "required|min:3|max:100",
        ]);

        $role->fill($request->all());
        if ($role->save()) {
            Alert::success('','Registro actualizado');
        }

        return back()->with('message', 'item updated successfully');
    }
}
