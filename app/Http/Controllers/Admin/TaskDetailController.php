<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskConfig;
use App\Models\TaskDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = TaskDetail::paginate(10);

        return view('cruds.tasks_detail.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruds.tasks_detail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "task_config_id" => "required",
            "description"    => "required|min:3|max:100",
            "link"           => "required|url|min:14",
        ]);

        $task_detail = new TaskDetail();
        $task_detail->fill($request->all());
        $task_detail->created_users = Auth::id();
        if ($task_detail->save()) {
            //Todo: alerta
        }

        return redirect()->route('task.edit', $task_detail);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TaskConfig $task
     * @return \Illuminate\Http\Response
     */
    public function show(TaskDetail $detail)
    {
        return view('cruds.tasks_detail.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TaskDetail $task
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskDetail $detail)

    {

        $data = $detail;
        $detail = TaskDetail::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        return view('cruds.tasks_detail.edit', compact('detail', 'users', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TaskDetail $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskDetail $detail)
    {
        $this->validate($request, [
            "task_config_id" => "required",
            "description"    => "required|min:3|max:100",
            "link"           => "required|url|min:14",
        ]);

        $detail->fill($request->all());
        $detail->created_users_id = Auth::id();
        if ($detail->update()) {
            //Todo: alerta
            return redirect()->route('task.edit', $detail);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TaskConfig $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskDetail $detail)
    {
        $detail->delete();

        return back()->with('message', 'item deleted successfully');
    }
}
