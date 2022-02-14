<?php

namespace App\Http\Controllers\Admin;

use Acaronlex\LaravelCalendar\Calendar;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarController extends Controller
{
    public function index()
    {

        return view('cruds.calendar.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_time'  => 'required|',
            'end_time'    => 'required',
            'description' => 'required',
            'title' => 'required',
        ]);

        $event = new CalendarEvent();
        $event->fill($request->all());
        $event->created_user = \Auth::id();
        if ($event->save()) {
            Alert::success('Se ha agregado un nuevo evento');
        }
        return redirect()->back();
    }

    public function getCalendar()
    {
        $events = [];
        $db = CalendarEvent::all();
        foreach ($db as $row) {
            $events[] = Calendar::event(
                $row->description, //event title
                false, //full day event?
                $row->start_time, //start time (you can also use Carbon instead of DateTime)
                $row->end_time //end time (you can also use Carbon instead of DateTime)
            );
        }

        $calendar = new Calendar();
        $calendar->addEvents($events)
            ->setOptions([
                'locale'           => 'es',
                'firstDay'         => 1,
                'displayEventTime' => true,
                'selectable'       => true,
                'initialView'      => 'dayGridMonth',
                'headerToolbar'    => [
                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
                ]
            ]);
        $calendar->setId('1');
        $calendar->setCallbacks([
            'select'     => 'function(selectionInfo){}',
            'eventClick' => 'function(event){}'
        ]);
        return $calendar;
    }
}
