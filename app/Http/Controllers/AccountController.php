<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
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
        return view('authentication.sign_up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {   
        if (!isset($request->user_avatar)) {
        DB::table('accounts')->insert([
            'name' => $request->nickname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'birth_place_date' => $request->date_place_birth,
            'region' => $request->region,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('start_login')->with('success', 'Akun berhasil di buat');
        }
        // else {

        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
