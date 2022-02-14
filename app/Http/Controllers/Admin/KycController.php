<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycDocument;
use App\Models\KycType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kycs = KycDocument::orderBy('created_at', 'desc')->paginate(10);

        return view('cruds.kycs.index', compact('kycs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = KycType::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        return view('cruds.kycs.create', compact('types', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "kyc_types_id" => "required",
            "file"         => "required|mimes:jpg,jpeg,png,pdf"
        ]);

        $file = $request->file('file');

        $kyc = new KycDocument();
        $kyc->fill($request->all());
        $kyc->file = $file->getClientOriginalName();

        if (!isset($request->users_id)) {
            $kyc->users_id = Auth::id();
        }

        if ($kyc->save()) {
            $request->file->storeAs('users/' . $kyc->users_id . '/kyc/', $kyc->id . '.' . $file->getClientOriginalExtension());
            Alert::success('', 'Registro exitoso');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\KycDocument $kyc
     * @return \Illuminate\Http\Response
     */
    public function show(KycDocument $kyc)
    {
        return view('kycs.show', compact('kyc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\KycDocument $kyc
     * @return \Illuminate\Http\Response
     */
    public function edit(KycDocument $kyc)
    {
        $data = $kyc;
        $types = KycType::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        return view('cruds.kycs.edit', compact('types', 'users', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KycDocument $kyc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KycDocument $kyc)
    {
        $validated = $request->validate([
            "users_id"     => "required",
            "kyc_types_id" => "required",
            "comment"      => "required|min:3|max:100",
            "file"         => "required|mimes:jpg,jpeg,png,pdf"
        ]);

        $file = $request->file('file');

        $kyc->fill($request->all());
        $kyc->file = $file->getClientOriginalName();
        if ($kyc->update()) {
            $request->file->storeAs('users/' . $request->users_id . '/kyc/', $kyc->id . '.' . $file->getClientOriginalExtension());
            //TODO: Colocar alerta
        }

        return back()->with('message', 'item updated successfully');
    }

    /**
     * Metodo con el cual se actualiza el estatus en la base de datos
     * @param Request $request
     * @param KycDocument $kyc
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApprovedState(KycDocument $kyc, $status, $comment = null)
    {
        if ($kyc) {
            $kyc->status = $status;
            $kyc->approved_id = Auth::id();
            if ($comment)
                $kyc->comment = $comment;
            $kyc->save();
        }

        Alert::success('', __('Estado actualizado'));
        return redirect()->back();
    }

    public function updateRejectState(Request $request, KycDocument $kyc)
    {
        if ($kyc) {
            $kyc->status = "2";
            $kyc->approved_id = Auth::id();
            $kyc->comment = $request->comment;
            if ($kyc->save()) {
                Alert::success('', __('Estado actualizado'));
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\KycDocument $kyc
     * @return \Illuminate\Http\Response
     */
    public function destroy(KycDocument $kyc)
    {
        $kyc->delete();
        Alert::success('', __('Registro eliminado'));

        return redirect()->back();
    }

    /**
     * @param KycDocument $kycDocument
     * @param null $type
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     * @TODO type 1 para visualizacion / null para descarga
     */
    public function download(KycDocument $kycDocument, $type = null)
    {
        if ($type == 1) {
            // visualizacion
            $path = 'users/' . $kycDocument->users_id . '/kyc/' . $kycDocument->id . '.' . File::extension($kycDocument->file);
            return Storage::exists($path) ? Storage::response($path) : null;
        } else {
            // descarga por usuario
            $path = 'users/' . Auth::id() . '/kyc/' . $kycDocument->id . '.' . File::extension($kycDocument->file);
            if (Storage::exists($path))
                return Storage::download($path, $kycDocument->file);
            else {
                Alert::error('', __('Archivo no encontrado'));
                return redirect()->back();
            }
        }
    }

    /**
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function searchByFilter(Request $request)
    {

        $kycs = KycDocument::select('kyc_documents.*')->join('users', 'users.id', '=', 'kyc_documents.users_id');

        if ($request->username)
            $kycs = $kycs->where('username', 'like', '%' . $request->username . '%');
        if ($request->dateIn != null && $request->dateEnd != null)
            $kycs = $kycs->whereBetween('kyc_documents.created_at', [$request->dateIn, $request->dateEnd]);

        $kycs = $kycs->orderBy('kyc_documents.created_at', 'desc')->get();

        return view('cruds.kycs.components.list_table', compact('kycs'))->render();

    }
}
