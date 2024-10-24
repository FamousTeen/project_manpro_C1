<?php

namespace App\Http\Controllers;

use App\Models\Misa;
use App\Models\Account;
use App\Models\Misa_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreMisa_DetailRequest;
use App\Http\Requests\UpdateMisa_DetailRequest;

class MisaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $misa_details = Misa_Detail::all();
        return view('anggota.jadwal', compact('misa_details'));
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
    public function store(StoreMisa_DetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // Fetch data for the dashboard
        $userData = Account::query()->where(
            'email',
            $user->email
        )->where('password', $user->password)->firstOrFail();

        $misa = Misa_Detail::get()->where('account_id', $user->id);

        $ministers = [];
        foreach ($misa as $m) {
            // for ($x = 0; $x < sizeof($misa); $x++) {
            array_push($ministers, Misa_Detail::get()->where('misa_id', $m->misa_id));
            // }
        }

        // dd(vars: $ministers);

        return view('anggota.evaluasi', [
            'misa' => $misa,
            'data' => $userData,
            'ministers' => $ministers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Misa_Detail $misa_Detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMisa_DetailRequest $request, Misa_Detail $misa_Detail)
    {
        //
    }

    public function updateEval(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $misaDetail = Misa_Detail::where('id', $request->id)->where('account_id', $user->id)->where('roles', 'Pengawas')->first();

        $formfield = Validator::make($data, [
            'evaluation' => 'required|string',
        ]);
        $validatedData = $formfield->validate();

        $misa = Misa::find($misaDetail->misa_id);
        $misa->update($validatedData);

        return redirect()->route('evaluasi_anggota')->with('success', 'Evaluation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Misa_Detail $misa_Detail)
    {
        //
    }
}
