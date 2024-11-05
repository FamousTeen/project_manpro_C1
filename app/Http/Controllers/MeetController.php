<?php

namespace App\Http\Controllers;

use App\Models\Meet;
use App\Http\Requests\StoreMeetRequest;
use App\Http\Requests\UpdateMeetRequest;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreMeetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Meet $meet)
    {
        return view('admin.detail_rapat', [
            'meet' => $meet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meet $meet)
    {
        return view('admin.edit_rapat', compact('meet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetRequest $request, Meet $meet)
    {
        $request->validate([
            'meetNotulen' => 'required',
        ]);

        $meet->update([
            'notulen' => $request->meetNotulen
        ]);

        return redirect()->route('meets.show', compact('meet'))->with('success', 'Rapat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meet $meet)
    {
        //
    }
}
