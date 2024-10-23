<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch data for the dashboard
        $userData = Account::query()->where(
            'email',
            $user->email
        )->where('password', $user->password)->firstOrFail();
        
        $events = Event::query()->where('status', 1)->get();
        return view('anggota/alur_acara/acara', [
            'events' => $events,
            'data' => $userData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $user = Auth::user();

        // Fetch data for the dashboard
        $userData = Account::query()->where(
            'email',
            $user->email
        )->where('password', $user->password)->firstOrFail();

        $selectedEvent = Event::query()->where('id', $event->id)->firstOrFail();
        return view('anggota/alur_acara/detail_acara', [
            'selectedEvent' => $selectedEvent,
            'data' => $userData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
