<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\EventDetail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = null;
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $events = Event::where('status', 1)->get();

            return view('admin.daftar_acara', [
                'user' => $user,
                'events' => $events
            ]);

        } elseif (Auth::guard('account')->check()) {
            $user = Auth::guard('account')->user();

            // Fetch data for the dashboard
            $userData = Account::query()->where(
                'email',
                $user->email
            )->where('password', $user->password)->firstOrFail();

            $events = Event::query()->where('status', 1)->get();
            return view('anggota/alur_acara/acara', [
                'events' => $events,
                'user' => $userData
            ]);
        }
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
        $user = null;
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        } elseif (Auth::guard('account')->check()) {
            $user = Auth::guard('account')->user();
        }

        // Fetch data for the dashboard
        $userData = Account::query()->where(
            'email',
            $user->email
        )->where('password', $user->password)->firstOrFail();

        $selectedEvent = Event::query()->where('id', $event->id)->firstOrFail();
        return view('anggota/alur_acara/detail_acara', [
            'selectedEvent' => $selectedEvent,
            'user' => $userData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.edit_acara', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'finished_time' => 'required',
            'event_chief' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required',
            'place' => 'required'
        ]);

        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'finished_time' => $request->finished_time,
            'contact_person' => $request->contact_person,
            'phone_number' => $request->phone_number,
            'place' => $request->place,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $chiefDetail = EventDetail::where('event_id', $event->id)->where('roles', 'Ketua');

        $chiefDetail->update([
            'account_id' => $request->event_chief
        ]);

        return redirect()->route('events.index')->with('success', 'Rapat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
