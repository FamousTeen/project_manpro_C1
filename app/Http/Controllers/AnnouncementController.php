<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Account;
use App\Models\AnnouncementDetail;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/post_pengumuman');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $request->validate([
            'eventDesc' => 'required'
        ]);


        $created_announcement = Announcement::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'upload_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'description' => $request->eventDesc,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $account_count = Account::where('status', 1)->count();

        for ($i = 1; $i <= $account_count; $i++) {
            if ((Account::where('id', $i)->firstOrFail()->roles) == "Anggota") {
                AnnouncementDetail::create([
                    'announcement_id' => $created_announcement->id,
                    'account_id' => $i
                ]);
            }
        }

        return redirect()->route('announcements.create')->with('success2', 'Announcement berhasil dibuat dan disebarkan ke seluruh anggota dan pengurus.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $request->validate([
            'eventDesc' => 'required'
        ]);

        $announcement->update([
            'description' => $request->eventDesc,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('announcements.create')->with('success', 'Announcement berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $isUpdated = $announcement->update([
            'status' => 0,
        ]);

        return redirect()->route('announcements.create')->with('success', 'Announcement berhasil dihapus.');
    }
}
