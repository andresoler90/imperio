<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ReportsController extends Controller
{
    public function referred_index()
    {
        return view('reports.referred.index');
    }

    public function referred_ajax(Request $request)
    {
        if ($request->ajax()) {

            if (Auth::user()->roles_id == 1)
                $query = User::query();
            else
                $query = User::query()->where('sponsor_id',Auth::id());

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => e($row->created_at->format('d/m/Y H:i:s')),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
                })
                ->addColumn('sponsor', function ($row) {
                    return $row->sponsor?$row->sponsor->username:'';
                })
                ->addColumn('membership', function ($row) {
                    return $row->userMembership?$row->userMembership->membership->name:'';
                })
                ->addColumn('state', function ($row) {
                    if(isset($row->userMembership)){
                        if ($row->userMembership->hasApprovedVerification())
                            $state = '<span class="badge badge-success">Activo</span>';
                        else
                            $state = '<span class="badge badge-warning">Pendiente</span>';
                    } else
                        $state = '';

                    return $state;
                })
                ->rawColumns(['state'])
                ->make(true);
        }
    }
}
