<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;
use App\Http\Requests\EventRegisterValidation;
use App\Exports\EventsExport;
use App\Imports\EventsImport;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    private function today_events() {
        $today = Carbon::now()->format('Y-m-d');

        return User::find(Auth::id())->events()
            ->where('start_date', '<', "$today "."23:59:59")
            ->where('end_date', '>', "$today "."00:00:00")
            ->get();
    }

    private function next_five_days_events() {
        $today = Carbon::now()->format('Y-m-d');
        $next_five_days = date_create('+5 day')->format('Y-m-d');

        return User::find(Auth::id())->events()
            ->where('start_date', '>', "$today "."23:59:59")
            ->where('start_date', '<=', "$next_five_days "."23:59:59")
            ->get();
    }
    
    public function index() {
        
        $events = User::find(Auth::id())->events()->paginate(5);
        $today_events = $this->today_events();
        $next_five_days_events = $this->next_five_days_events();
        
        return view('events', [
            'all_events' => $events,
            'today_events' => $today_events,
            'next_five_days_events' => $next_five_days_events
        ]);
    }

    public function store(EventRegisterValidation $request) {

        $start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');

        $event = new Event;
        $event->title = $request->title;
        $event->user_id = Auth::id();
        $event->description = $request->description;
        $event->start_date = $start_date;
        $event->end_date = $end_date;
        $event->save();

        return redirect()->route('event.index');
    }

    public function edit($id)
    {
        $user = Auth::id();
        $event = Event::find($id);
        
        if($event->user_id !== $user)
        {
            return redirect()->route('event.index');
        }
        
        if(!$event)
        {
            return redirect()->route('event.create');
        }
        return view('event_edit', compact('event'));
    }

    public function update(EventRegisterValidation $request) 
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');

        Event::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        return redirect()->route('event.index');
    }

    public function delete($id) {
        $event = Event::find($id);
        $event->delete();

        return redirect()->route('event.index');
    }

    public function create() {
        return view('event_create');
    }
   
    public function export() 
    {
        return Excel::download(new EventsExport, 'eventos.csv');
    }
   
    public function import() 
    {
        Excel::import(new EventsImport,request()->file('file'));
           
        return back();
    }
}
