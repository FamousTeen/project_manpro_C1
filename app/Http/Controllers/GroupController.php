<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Account;
use App\Models\GroupDetail;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
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
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'anggota' => 'required|array',
            'anggota.*' => 'exists:accounts,id', // Ensure all members exist in the Account table
        ]);

        $group = Group::create([
            'name' => $validated['group_name'],
        ]);

        // Attach members
        $group->members()->attach($validated['anggota']);

        return response()->json([
            'message' => 'Group created successfully',
            'group' => $group
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        // Delete related records from group_details
        $group->groupDetails()->delete();

        // Now delete the group itself
        $group->delete();

        return redirect()->route('input_anggota_pelatihan')->with('success', 'Group deleted successfully!');
    }


    public function inputAnggotaPelatihan()
    {
        // Fetch groups and their details
        $groups = Group::with('groupDetails')->get();

        return view('admin.training.input_anggota_pelatihan', compact('groups'));
    }

    public function addMember(Request $request, Group $group)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
        ]);

        $groupDetail = GroupDetail::create([
            'group_id' => $group->id,
            'account_id' => $request->account_id,
        ]);

        return response()->json([
            'success' => true,
            'member' => $groupDetail,
        ]);
    }
    public function updateMembers(Request $request, $groupId)
    {
        // Fetch the group or fail if not found
        dd($request->all());
        $group = Group::findOrFail($groupId);

        // Validate the input data
        $request->validate([
            'member_ids' => 'required|array',
            'member_ids.*' => 'exists:accounts,id', // Ensure IDs are valid
        ]);

        // Remove all existing members from the group
        $group->groupDetails()->delete();

        // Add new members to the group
        foreach ($request->member_ids as $accountId) {
            $group->groupDetails()->create([
                'account_id' => $accountId, // Directly use account_id
            ]);
        }

        return redirect()->route('input_anggota_pelatihan', $groupId)
            ->with('success', 'Group members updated successfully.');
    }
}
