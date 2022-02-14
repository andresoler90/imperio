<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Libs\BonusMethods;
use App\Models\BonusRoi;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function roi()
    {
        $logRoi = BonusRoi::paginate();
        //dd($logRoi);
        return view('admin.roi.index', compact('logRoi'));
    }

    public function roiNew()
    {
        $memberships = Membership::all();
        return view('admin.roi.new', compact('memberships'));
    }

    public function roiExecute(Request $request)
    {
        $bonusMethods = new BonusMethods();
        if ($bonusMethods->roi($request->membership)) {
            $roiLog = new BonusRoi();
            $roiLog->detail = json_encode($request->membership);
            $roiLog->created_users_id = Auth::id();
            if ($roiLog->save()) {
                Alert::success('ROI', 'Se culmino el pago del bono ROI');
                return redirect()->route('roi.index');
            }
        }
    }
}
