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
        // Validate your inputs first
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'activity_datetime' => 'required|date',
            'activity_time' => 'required|string', // Ensure time is validated
            'upload_datetime' => 'date',
            'upload_time' => 'date',
            'anggotaId' => 'required',
            'roles' => 'required',
            
        ]);


        // Retrieve the date and time from the request
        $activityDate = $request->input('activity_datetime'); // e.g., '2024-11-03'
        $activityTime = $request->input('activity_time'); // e.g., '14:00'

        // Create a Carbon instance from the date and time
        $activityDateTime = Carbon::createFromFormat('Y-m-d H:i', "$activityDate $activityTime");
        dd($activityDateTime);


        // Now insert into the database using Eloquent if possible
        $misa = Misa::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'activity_datetime' => $activityDateTime->format('Y-m-d H:i:s'),
            'upload_datetime' => Carbon::now()->format('Y-m-d H:i:s'),
            'evaluation' => "",
            'status' => "Proses",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Optionally, if you are collecting Misa_Detail data as well
        if ($request->has('anggota')) {
            foreach ($request->input('anggota') as $anggotaData) {
                // Ensure $anggotaData has all required fields before proceeding
                $misaDetailData = [
                    'misa_id' => $misa->id, // associate with the created Misa
                    'account_id' => $anggotaData['account_id'], // adapt as necessary
                    'roles' => $anggotaData['roles'], // adapt as necessary
                    'participation' => $anggotaData['participation'], // adapt as necessary
                    'confirmation' => $anggotaData['confirmation'], // adapt as necessary
                ];

                // Create Misa_Detail using Eloquent
                Misa_Detail::create($misaDetailData);
            }
        }

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
