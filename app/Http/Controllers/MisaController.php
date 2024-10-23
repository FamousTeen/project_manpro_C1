<?php

namespace App\Http\Controllers;

use App\Models\Misa;
use App\Http\Requests\StoreMisaRequest;
use App\Http\Requests\UpdateMisaRequest;

class MisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $misas = Misa::with('misaDetails')->get();
        return view('anggota.jadwal', compact('misas'));
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
