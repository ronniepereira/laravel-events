<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    
    public function index() {
        $today = Carbon::now()->format('Y-m-d');    
        $next_five_days = date_create('+5 day')->format('Y-m-d');
        
        $events = Event::where('user_id', Auth::id())->paginate(5);
        $today_events = Event::where('user_id', Auth::id())
                                ->whereBetween('start_date', ["$today ". '00:00:00', "$today ". '23:59:59'])->get();
        $next_five_days_events = Event::where('user_id', Auth::id())
                                ->whereBetween('start_date', ["$today " . "00:00:00", "$next_five_days " . "23:59:59"])->get();


        return view('events', [
            'all_events' => $events,
            'today_events' => $today_events,
            'next_five_days_events' => $next_five_days_events
        ]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:200',
            'start_date' => "date",
            'end_date' => "date|after_or_equal:start_date",
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        
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

    public function update(Request $request) 
    {
        Log::alert($request->start_date);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:200',
            'start_date' => "date",
            'end_date' => "date|after_or_equal:start_date",
        ]);

        
        if ($validator->fails()) {
            Log::alert($validator->errors());
            return back()
                ->withErrors($validator)
                ->withInput();
        }

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
}
