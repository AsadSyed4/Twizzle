<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarEventModel;
use Spatie\IcalendarGenerator\Components\Calendar;

class CalendarEventController extends Controller
{
    public function index(Request $request)
    {
        if (session()->get('LoggedIn')) {
            $user_id = session()->get('user_id');
            if ($request->ajax()) {
                $events = CalendarEventModel::whereDate('start', '>=', $request->start)
                    ->whereDate('end', '<=', $request->end)->where('user_id', '=', $user_id)
                    ->get();

                return response()->json($events);
            }
            return view('calendar');
        } else {
            notify()->info('Please Login or Register for Calendar.', '', 'topRight');
            return redirect('/');
        }
    }

    public function get_event(Request $request)
    {
        if (session()->get('LoggedIn')) {            
            if ($request->ajax()) {
                $event = CalendarEventModel::where('id', '=', $request->id)->first();
                return response()->json([
                    'success' => true,
                    'event' => $event
                ]);
            }
            return view('calendar');
        } else {
            notify()->info('Please Login or Register for Calendar.', '', 'topRight');
            return redirect('/');
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'etype' => 'required',            
            'description' => 'required'
        ]);

        $event = new CalendarEventModel();
        $event->user_id = session()->get('user_id');
        $event->title = $request->title;
        $event->type = $request->etype;
        $event->description = $request->description;
        if(isset($request->current_day)){
            $event->start = date("Y-m-d H:i:s");
            $event->end = date("Y-m-d")." 00:00:00";
        }else{
            if(!empty($request->end_date)){
                $event->start = $request->start_date . ' ' . $request->start_time;
                $event->end = $request->end_date . ' ' . $request->end_time;
            }else{
                $event->start = $request->start_date . ' ' . $request->start_time;
                $event->end = $request->start_date . ' 00:00:00';
            }            
        }        
        if ($event->save()) {
            notify()->success('Added.', '', 'topright');
        } else {
            notify()->error('Try Again.', '', 'topright');
        }
        return redirect()->back();
    }

    public function edit(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);


        $event = CalendarEventModel::where('id', $request['id'])
            ->update([
                'start' => $request['start'],
                'end' => $request['end'],
            ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    public function destroy(Request $request)
    {
        $found = CalendarEventModel::find($request->e_id);
        if (!is_null($found)) {
            if (CalendarEventModel::where('id', $request->e_id)->delete()) {
                notify()->success('Event removed successfully.','','topRight');
                return redirect()->back();
            } else {
                notify()->error('Event not removed.','','topRight');
                return redirect()->back();
            }
        } else {
            notify()->error('Event not found.','','topRight');
                return redirect()->back();
        }
    }
    public function getEventsICalObject()
    {
        $user_id = session()->get('user_id');
        $event_find = CalendarEventModel::where('user_id', '=', $user_id)->get();
        if (!empty($event_find)) {
            $events = CalendarEventModel::where('user_id', '=', $user_id)->get();
            define('ICAL_FORMAT', 'Ymd\THis\Z');
            $icalObject = "";

            $icalObject = "BEGIN:VCALENDAR
            VERSION:2.0
            METHOD:PUBLISH
            PRODID:-//" . $user_id . "//Events//EN\n";

            // loop over events
            foreach ($events as $event) {
                $icalObject .=
                    "BEGIN:VEVENT
                    DTSTART:" . date(ICAL_FORMAT, strtotime($event->start)) . "
                    DTEND:" . date(ICAL_FORMAT, strtotime($event->end)) . "
                    DTSTAMP:" . date(ICAL_FORMAT, strtotime($event->created_at)) . "
                    SUMMARY:$event->title
                    UID:$event->user_id
                    LAST-MODIFIED:" . date(ICAL_FORMAT, strtotime($event->updated_at)) . "
                    END:VEVENT\n";
            }

            // close calendar
            $icalObject .= "END:VCALENDAR";

            // Set the headers
            header('Content-Disposition: attachment; filename="' . $user_id . '-cal.ics"');
            header("Content-type", "text/calendar; charset=utf-8");

            $icalObject = str_replace(' ', '', $icalObject);

            echo $icalObject;
        }
    }
}
