<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Misa;
use App\Models\Account;
use App\Models\Misa_Detail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateMisaRequest;


class MisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = null;
        $accounts = Account::all(); // Fetch all accounts

        // Count the duties for each account by counting occurrences in misa_details
        $dutyCounts = DB::table('misa_details')
            ->select('account_id', DB::raw('count(*) as duty_count'))
            ->groupBy('account_id')
            ->get()
            ->keyBy('account_id'); // Key the result by account_id for easier access

        if (Auth::guard('admin')->check()) {
            return view('admin/input_misa', compact('accounts', 'dutyCounts'));
        } elseif (Auth::guard('account')->check()) {
            $user = Auth::guard('account')->user();
            $userData = Account::query()->where(
                'email',
                $user->email
            )->where('password', $user->password)->firstOrFail();

            $misas = Misa::with('misaDetails')->whereHas('misaDetails', function ($query) use ($userData) {
                $query->where('account_id', $userData->id);
            })->get();

            return view('anggota/jadwal', [
                'misas' => $misas,
                'data' => $userData,
                'accounts' => $accounts,
                'dutyCounts' => $dutyCounts // Pass dutyCounts to the view
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin/input_misa', compact('accounts', 'dutyCounts')); // Pass both variables to the view
    }



    public function store(Request $request)
    {
        $accounts = Account::all();

        $selectedOptions = $request->input('selectedOptions');
        $selectedOptions2 = $request->input('selectedOptions2');

        $memberIdArray = explode(",", $selectedOptions[0]);
        $rolesArray = explode(",", $selectedOptions2[0]);

        // Validate inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'activity_datetime' => 'required|date', // Date validation
            'activity_time' => 'required|date_format:H:i', // Time validation
            'upload_datetime' => 'nullable|date',
            'upload_time' => 'nullable|date_format:H:i',

            'customTugas' => 'array',
            'customTugas.*' => 'nullable|string|max:255', // Optional custom tasks
        ]);
        // Merge activity date and time into a single Carbon instance
        $activityDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->activity_datetime . ' ' . $request->activity_time);

        // Merge upload date and time, defaulting to current date/time if not provided
        $uploadDate = $request->input('upload_datetime') ?? Carbon::now()->format('Y-m-d');
        $uploadTime = $request->input('upload_time') ?? Carbon::now()->format('H:i');
        $uploadDateTime = Carbon::createFromFormat('Y-m-d H:i', "$uploadDate $uploadTime");

        // Insert into the `Misa` table
        $misa = Misa::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'activity_datetime' => $activityDateTime->format('Y-m-d H:i'),
            'upload_datetime' => $uploadDateTime->format('Y-m-d H:i:s'),
            'evaluation' => "",
            'status' => "Proses",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // If there are `anggota` entries, store each `Misa_Detail` record
        for ($i = 0; $i < count($memberIdArray); $i++) {
            // Get corresponding role and custom task (if any)
            $role = $rolesArray[$i];
            $account_id = $memberIdArray[$i];

            // Prepare data for `Misa_Detail` entry
            $misaDetailData = [
                'misa_id' => $misa->id, // Associate with created Misa
                'account_id' => $account_id,
                'roles' => $role,
                'participation' => null,
                'confirmation' => null
            ];

            // Insert into the `Misa_Detail` table
            Misa_Detail::create($misaDetailData);
        }

        // Redirect with success message
        return redirect()->route('input_misa')->with('success', 'Misa created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Misa $misa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Misa $misa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMisaRequest $request, Misa $misa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Misa $misa)
    {
        //
    }
}
