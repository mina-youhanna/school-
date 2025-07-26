<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Event::orderByDesc('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|string',
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'date' => 'required|string|max:100',
        ]);
        $event = Event::create($data);
        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'image' => 'sometimes|required|string',
            'title' => 'sometimes|required|string|max:255',
            'details' => 'sometimes|required|string',
            'date' => 'sometimes|required|string|max:100',
        ]);
        $event->update($data);
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['success' => true]);
    }
}
