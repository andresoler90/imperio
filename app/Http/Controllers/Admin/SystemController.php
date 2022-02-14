<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class SystemController extends Controller
{
    function index()
    {
        $systems = System::all();
        return view('admin.system', compact('systems'));
    }

    function update(Request $request)
    {
        foreach ($request->parameters as $parameter => $value) {

            $system = System::where('parameter', $parameter)->first();
            if ($system->value != $value) {
                $system->value = $value;
                $system->save();
            }
        }

        Alert::success('Sistema', 'Datos actualizados');
        return redirect()->back();
    }

    function weakLeg()
    {
        Artisan::call('bonus:weakleg');
        Alert::success('Sistema', 'Bono de pierna debil ejecutado');
        return redirect()->back();
    }

    function regenerateRanks()
    {
        Artisan::call('multilevel:regenerateranks');
        Alert::success('Sistema', 'La actualización de rango se generado');
        return redirect()->back();
    }
}
