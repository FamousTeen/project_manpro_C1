<?php

namespace App\Http\Controllers;

use App\Models\Misa;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMisaRequest;
use App\Http\Requests\UpdateMisaRequest;

class MisaController extends Controller
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


        $misas = Misa::with('misaDetails')->whereHas('misaDetails', function ($query) use ($userData) {
                $query->where('account_id', $userData->id);
        })->get();

        return view('anggota/jadwal', [
            'misas' => $misas,
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
    public function store(StoreMisaRequest $request)
    {
        //
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
