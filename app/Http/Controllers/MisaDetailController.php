<?php

namespace App\Http\Controllers;

use App\Models\Misa_Detail;
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
    public function show(Misa_Detail $misa_Detail)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Misa_Detail $misa_Detail)
    {
        //
    }
}
