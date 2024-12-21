<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Http\Resources\ResponsResource;
use DB;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $mobil = DB::table('mobil')->get();
        $mobil = Mobil::all();
        return new ResponsResource(true, 'Data Mobil', $mobil);
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
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'brand' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric|gte:10000000',
            'ketersediaan' => 'required|in:tersedia,kosong',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mobil = Mobil::create([
            'brand' => $request->brand,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'ketersediaan' => $request->ketersediaan,
            'deskripsi' => $request->deskripsi
        ]);
        return new ResponsResource(true, 'Berhasil Menambahkan Mobil', $mobil);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $mobil = Mobil::select('brand', 'nama', 'harga', 'ketersediaan', 'deskripsi')
        -> where('mobil.id', '=', $id)
        -> get();

        return new ResponsResource(true, 'Detail Mobil', $mobil);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $mobil = Mobil::select('brand', 'nama', 'harga', 'ketersediaan', 'deskripsi')
        -> where('mobil.id', '=', $id)
        -> get();

        return new ResponsResource(true, 'Detail Mobil', $mobil);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'brand' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric|gte:10000000',
            'ketersediaan' => 'required|in:tersedia,kosong',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mobil = Mobil::whereId($id)->update([
            'brand' => $request->brand,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'ketersediaan' => $request->ketersediaan,
            'deskripsi' => $request->deskripsi
        ]);
        
        return new ResponsResource(true, 'Berhasil Mengubah Data Mobil', $mobil);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mobil = Mobil::whereId($id)->first();
        $mobil->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data Mobil', $mobil);
    }
}
