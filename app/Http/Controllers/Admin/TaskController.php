<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskConfig;
use App\Models\TaskDetail;
use App\Models\UserTask;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = TaskConfig::paginate(10);

        return view('cruds.tasks_config.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruds.tasks_config.create');
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
            "name" => 'required',
            "periodicity" => "required",
            "date" => "required|date_format:Y-m-d",
        ]);

        $task_config = new TaskConfig();
        $task_config->fill($request->all());
        $task_config->created_users_id = Auth::id();
        if ($task_config->save()) {
            //Todo: alerta
        }

        return redirect()->route('task.edit', $task_config->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TaskConfig $task
     * @return \Illuminate\Http\Response
     */
    public function show(TaskConfig $configs)
    {
        return view('cruds.tasks_config.show', compact('config'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TaskDetail $task
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskConfig $task)
    {

        $data = $task;
        $taskLists = TaskDetail::where('task_config_id', $task->id)->get();
        $detail = TaskDetail::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        return view('cruds.tasks_config.edit', compact('detail', 'users', 'data','taskLists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TaskConfig $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskConfig $config)
    {
        $this->validate($request, [
            "name" => 'required',
            "periodicity" => "required",
            "date" => "required|date_format:Y-m-d",
        ]);

        $config->fill($request->all());
        $config->created_users_id = Auth::id();
        if ($config->update()) {
            //Todo: alerta
            return redirect()->route('task.edit', $config);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TaskConfig $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskConfig $task)
    {
        $task->delete();

        return back()->with('message', 'item deleted successfully');
    }
}
