<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meet;
use App\Models\Event;
use App\Models\Account;
use App\Models\EventDetail;
use App\Models\EventPermission;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Validator;

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
        $data = $request->all();
        foreach (['chief2', 'secretary', 'secretary2', 'treasurer', 'treasurer2'] as $nullableField) {
            if (empty($data[$nullableField])) {
                $data[$nullableField] = null;
            }
        }

        $validator = Validator::make($data, [
            'title' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'finished_time' => 'required',
            'place' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required',
            'description' => 'required',
            'poster' => 'required|file|mimes:jpg,jpeg,png',
            'chief' => 'required',
            'chief2' => 'nullable',
            'secretary' => 'nullable',
            'secretary2' => 'nullable',
            'treasurer' => 'nullable',
            'treasurer2' => 'nullable',
            'rundown' => 'required|file|mimes:pdf',
            'selectedCommittee' => 'required|array',
            'selectedDivision' => 'required|array'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return the errors with the input back to the form
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $poster = $request->file('poster');
        $poster_name = $poster->getClientOriginalName();
        $poster->move(public_path('asset'), $poster_name);

        $rundown = $request->file('rundown');
        $rundown_name = $rundown->getClientOriginalName();
        $rundown->move(public_path('asset'), $rundown_name);


        $event = Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'finished_time' => $request->finished_time,
            'contact_person' => $request->contact_person,
            'phone_number' => $request->phone_number,
            'place' => $request->place,
            'description' => $request->description,
            'poster' => $poster_name,
            'rundown_image' => $rundown_name,
            'status' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        // Masukin ketua
        EventDetail::create([
            'event_id' => $event->id,
            'account_id' => (int)$request->chief,
            'roles' => 'Ketua',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        if ($request->chief2 != null) {
            // Masukin wakil ketua
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => (int)$request->chief2,
                'roles' => 'Wakil Ketua',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } else {
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => null,
                'roles' => 'Wakil Ketua',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }


        // Masukin sekretaris
        if ($request->secretary != null) {
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => (int)$request->secretary,
                'roles' => 'Sekretaris',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } else {
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => null,
                'roles' => 'Sekretaris',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        if ($request->secretary2 != null) {
            // Masukin sekretaris 2 kalau tidak null
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => (int)$request->secretary2,
                'roles' => 'Sekretaris',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        // Masukin bendahara
        if ($request->treasurer != null) {
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => (int)$request->treasurer,
                'roles' => 'Bendahara',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } else {
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => null,
                'roles' => 'Bendahara',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        if ($request->treasurer2 != null) {
            // Masukin sekretaris 2 kalau tidak null
            EventDetail::create([
                'event_id' => $event->id,
                'account_id' => (int)$request->treasurer2,
                'roles' => 'Bendahara',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        $selectedCommittee = json_decode($request->input('selectedCommittee')[0], true);
        $selectedDivision = json_decode($request->input('selectedDivision')[0], true);

        foreach ($selectedCommittee as $index => $account_id) {
            if ($selectedCommittee[$index] == null) {
                continue;
            }
            $division = $selectedDivision[$index] ?? null;

            $event_detailTemp = EventDetail::create([
                'event_id' => (int)$event->id,
                'account_id' => (int)$account_id,
                'roles' => $division,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        $array_event_details = EventDetail::where('event_id', $event->id)->get();

        $index_temp = 0;

        return redirect()->route('input_event')->with('success', 'Event  created successfully.');
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
        $event->update([
            'status' => 0
        ]);

        return redirect()->route('events.index')->with('success', 'Acara berhasil dihapus.');
    }
}
