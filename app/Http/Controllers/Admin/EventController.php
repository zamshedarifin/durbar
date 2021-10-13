<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->paginate(10);
        return view('admin.event.index', compact('events'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:200',
                'title_bn' => 'nullable|max:200',
                'description' => 'required',
                'description_bn' => 'nullable',
                'location' => 'required|max:200',
                'location_bn' => 'nullable|max:200',
                'event_date' => 'required|date',
                'cover' => 'required|mimes:png,jpg,jpeg|max:1024',
                'event_link' => 'nullable|max:200',
                'status' => 'required|max:2|numeric',
            ]);
            if ($request->hasFile('cover')) {
                $extension = $request->cover->getClientOriginalExtension();
                $cover = 'event_' . generateRandomString(22) . '.' . $extension;
                $request->cover->move(public_path("uploads/event/"), $cover);
            }
            $event = new Event();
            $event->title = $request->title;
            $event->title_bn = $request->title_bn;
            $event->description = $request->description;
            $event->description_bn = $request->description_bn;
            $event->location = $request->location;
            $event->location_bn = $request->location_bn;
            $event->event_date = date('Y-m-d', strtotime($request->event_date));
            $event->cover = $cover;
            $event->event_link = $request->event_link;
            $event->status = $request->status;
            $event->save();
            return redirect()->back()->with('success', 'Event has been created successfully.');

        } else {

            return view('admin.event.create');
        }
    }


    public function edit(Request $request, $id)
    {
        $id = unlock($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:200',
                'title_bn' => 'nullable|max:200',
                'description' => 'required',
                'description_bn' => 'nullable',
                'location' => 'required|max:200',
                'location_bn' => 'nullable|max:200',
                'event_date' => 'required|date',
                'cover' => 'mimes:png,jpg,jpeg|max:1024',
                'event_link' => 'nullable|max:200',
                'status' => 'required|max:2|numeric',
            ]);

            $event = Event::findOrFail($id);
            $event->title = $request->title;
            $event->title_bn = $request->title_bn;
            $event->description = $request->description;
            $event->description_bn = $request->description_bn;
            $event->location = $request->location;
            $event->location_bn = $request->location_bn;
            $event->event_date = date('Y-m-d', strtotime($request->event_date));

            if ($request->hasFile('cover')) {
                $extension = $request->cover->getClientOriginalExtension();
                $cover = 'event_' . generateRandomString(22) . '.' . $extension;
                $request->cover->move(public_path("uploads/event/"), $cover);
                $event->cover = $cover;
            }
            $event->event_link = $request->event_link;
            $event->status = $request->status;
            $event->save();
            return redirect()->back()->with('success', 'Event has been updated successfully.');

        } else {
            $event = Event::findOrFail($id);
            return view('admin.event.edit', compact('event'));
        }
    }


}
