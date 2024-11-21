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
        // Debug the request data to ensure 'member_ids' is an array


        // Validate the request data
        $request->validate([
            'member_ids' => 'required|array',  // Ensure it's an array
            'member_ids.*' => 'integer|exists:accounts,id', // Validate each account_id
        ]);

        // Retrieve the group by its ID
        $group = Group::findOrFail($groupId);

        // Get the array of account IDs from the request
        $accountIds = $request->input('member_ids');

        // Loop through the account IDs and add or update the group_details table
        foreach ($accountIds as $accountId) {
            // Check if a record exists in group_details for the group and account
            $existingGroupDetail = $group->groupDetails()->where('account_id', $accountId)->first();

            if (!$existingGroupDetail) {
                // If no existing record, create a new entry in group_details
                $group->groupDetails()->create([
                    'account_id' => $accountId,
                ]);
            }
        }

        // Optionally, return a response or redirect after the update
        return redirect()->route('input_anggota_pelatihan')->with('success', 'Group members updated successfully.');
    }
}
