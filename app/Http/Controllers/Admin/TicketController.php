<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketCategory;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TicketController extends Controller
{
    public function category_index()
    {
        $categories = TicketCategory::paginate(10);
        return view('cruds.tickets.categories.index', compact('categories'));
    }
    public function category_create()
    {
        return view('cruds.tickets.categories.create');
    }

    public function category_store(Request $request)
    {
        $validated = $request->validate([
            "category_name" => "required|min:3|max:100",
            "category_prefix" => "required|min:3|max:100",
        ]);

        $category = new TicketCategory();
        $category->fill($request->all());
        $category->category_prefix = str_replace(' ', '', $category->category_prefix);

        if ($category->save()) {
            Alert::success('', 'Registro exitoso');
            return redirect()->route('category.index', $category->id);
        }
    }

    public function category_edit(TicketCategory $category)
    {
        $data = $category;
        $categories = TicketCategory::all()->pluck('name', 'id');
        return view('cruds.tickets.categories.edit', compact('categories', 'data'));
    }

    public function category_update(Request $request, TicketCategory $category)
    {
        $validated = $request->validate([
            "category_name" => "required|min:3|max:100",
            "category_prefix" => "required|min:3|max:100",
        ]);

        $category->fill($request->all());
        if ($category->save()) {
            Alert::success('','Registro actualizado');
        }

        return redirect()->route('category.index');
    }

    public function category_active(TicketCategory $category, $active)
    {
        $category->active = $active;
        if ($category->save()) {
            Alert::success('','Edición exitosa');
        }

        return redirect()->back();
    }

    public function category_destroy(TicketCategory $category)
    {
        $category->delete();
        Alert::success('','Registro eliminado');
        return redirect()->back();
    }

    public function priority_index()
    {
        $prioritys = TicketPriority::paginate(10);
        return view('cruds.tickets.priority.index', compact('prioritys'));
    }

    public function priority_create()
    {
        return view('cruds.tickets.priority.create');
    }

    public function priority_store(Request $request)
    {
        $validated = $request->validate([
            "priority_name" => "required|min:3|max:100",
        ]);

        $priority = new TicketPriority();
        $priority->fill($request->all());
        if ($priority->save()) {
            Alert::success('', 'Registro exitoso');
            return redirect()->route('priority.index', $priority->id);
        }
    }

    public function priority_edit(TicketPriority $priority)
    {
        $data = $priority;
        $prioritys = TicketPriority::all()->pluck('name', 'id');
        return view('cruds.tickets.priority.edit', compact('prioritys', 'data'));
    }

    public function priority_update(Request $request, TicketPriority $priority)
    {
        $validated = $request->validate([
            "priority_name" => "required|min:3|max:100",
        ]);

        $priority->fill($request->all());
        if ($priority->save()) {
            Alert::success('','Registro actualizado');
        }

        return redirect()->route('priority.index');
    }

    public function priority_active(TicketPriority $priority, $active)
    {
        $priority->active = $active;
        if ($priority->save()) {
            Alert::success('','Edición exitosa');
        }

        return redirect()->back();
    }

    public function priority_destroy(TicketPriority $priority)
    {
        $priority->delete();
        Alert::success('','Registro eliminado');
        return redirect()->back();
    }

    public function status_index()
    {
        $status = TicketStatus::paginate(10);
        return view('cruds.tickets.status.index', compact('status'));
    }

    public function status_create()
    {
        return view('cruds.tickets.status.create');
    }

    public function status_store(Request $request)
    {
        $validated = $request->validate([
            "status_name" => "required|min:3|max:100",
        ]);

        $status = new TicketStatus();
        $status->fill($request->all());
        if ($status->save()) {
            Alert::success('', 'Registro exitoso');
            return redirect()->route('status.index', $status->id);
        }
    }

    public function status_edit(TicketStatus $status)
    {
        $data = $status;
        $status = TicketStatus::all()->pluck('name', 'id');
        return view('cruds.tickets.status.edit', compact('status', 'data'));
    }

    public function status_update(Request $request, TicketStatus $status)
    {
        $validated = $request->validate([
            "status_name" => "required|min:3|max:100",
        ]);

        $status->fill($request->all());
        if ($status->save()) {
            Alert::success('','Registro actualizado');
        }

        return redirect()->route('status.index');
    }

    public function status_active(TicketStatus $status, $active)
    {
        $status->active = $active;
        if ($status->save()) {
            Alert::success('','Edición exitosa');
        }

        return redirect()->back();
    }

    public function status_destroy(TicketStatus $status)
    {
        $status->delete();
        Alert::success('','Registro eliminado');
        return redirect()->back();
    }
}
