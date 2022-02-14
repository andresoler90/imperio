<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Product;
use App\Models\Rank;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class rankAdminController extends Controller
{
    public function index()
    {
        $ranks = Rank::all();
     //  dd($ranks);
        return view('cruds.ranks.index', compact('ranks'));
    }

    public function create()
    {
        return view('cruds.ranks.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        $validated = $this->validate($request, [
            "name" => "min:3|max:100",
            "pf" => "numeric",
            "pd" => "numeric",
            "requirements" => "string",
            "image" => "mimes:jpg,jpeg,png",
        ]);
        $image = $request->file('image');

        $ranks = new Rank();
        $ranks->fill($request->all());
        if(isset($image)) {
            $ranks->image = substr(md5(date('YmdHis')), 0, 7) . '.' . $image->getClientOriginalExtension();
            $request->image->storeAs('public/ranks/', $ranks->image);
        }
        if ($ranks->save()) {
            Alert::success('', 'Registro actualizado');
            return redirect()->route('rankAdmin.index');
        }
    }

    public function edit($id)
    {
        $ranks = Rank::where('id',$id)->first();
        return view('cruds.ranks.edit', compact('ranks' ));
    }

    public function update(Request $request, $id)
    {

        $validated = $this->validate($request, [
            "name" => "min:3|max:100",
            "pf" => "numeric",
            "pd" => "numeric",
            "requirements" => "string",
            "image" => "mimes:jpg,jpeg,png",
        ]);
      //  dd($request);
        $image = $request->file('image');
        $ranks = Rank::where('id',$id)->first();
        $ranks->fill($request->all());
        if(isset($image)) {
            $ranks->image = substr(md5(date('YmdHis')), 0, 7) . '.' . $image->getClientOriginalExtension();
            $request->image->storeAs('public/ranks/', $ranks->image);
        }
        if ($ranks->save()) {
            Alert::success('', 'Registro actualizado');
        }


        return redirect()->back();
    }

    public function destroy(Rank $ranks)
    {
        $ranks->delete();
        Alert::success('','Registro eliminado');
        return redirect()->back();
    }
}
