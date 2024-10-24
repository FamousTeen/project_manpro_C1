<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('anggota.profile.profile_anggota', $user);
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
    public function store(Request $request)
    {
        $data = $request->all();

        $formfield = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'address' => 'required',
            'birth_place_date' => 'required',
            'region' => 'required',
        ]);
        $validatedData = $formfield->validate();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = $photo->getClientOriginalName();
            $photo->move(public_path('asset'), $photo_name);
            $validatedData['photo'] = $photo_name;
        } else {
            $validatedData['photo'] = 'default.png';
        }

        $password_encrypt = bcrypt($validatedData['password']);
        $validatedData['password'] = $password_encrypt;

        Account::create($validatedData);

        return redirect()->route('start_login')->with('success', 'Akun berhasil di buat');
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
        $user = Auth::user();
        return view('anggota.profile.edit_profile_anggota', $user);
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
