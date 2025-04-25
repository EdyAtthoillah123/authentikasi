<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGolonganRequest;
use App\Http\Requests\UpdateGolonganRequest;
use App\Models\Golongan;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Golongan::all();
        return view('admin.golongan', compact('data'));
    }

    public function store(StoreGolonganRequest $request)
    {
        Golongan::create($request->validated());
        return redirect()->route('golongan');
    }

    public function update(UpdateGolonganRequest $request, Golongan $golongan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Golongan $golongan)
    {
        //
    }
}
