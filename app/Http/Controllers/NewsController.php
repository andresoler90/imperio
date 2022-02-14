<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use App\Models\News;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::query()->orderByDesc('id')->paginate(10);

        return view('cruds.news.index',compact('news'));

    }

    public function create()
    {
        $languages = Languages::pluck('language','id');

        return view('cruds.news.create',compact("languages"));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'languages_id' => 'required'
        ]);

        $news = new News();
        $news->users_id = \Auth::id();
        $news->fill($request->all());
        $news->save();

        Alert::success(__('Registro creado correctamente'));
        return redirect()->route('news.index');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $languages = Languages::pluck('language','id');

        return view('cruds.news.edit',compact('news','languages'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return void
     */
    public function update(Request $request, News $news)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $news->fill($request->all());
        if ($news->save()) {
            Alert::success('','Registro actualizado');
            return redirect()->route('news.index');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
