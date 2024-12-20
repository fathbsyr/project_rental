<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Http\Resources\ResponsResource;
use DB;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reservasi = Reservasi::join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
        ->join('mobil', 'reservasi.mobil_id', '=', 'mobil.id')
        -> select('reservasi.tanggal_mulai', 'reservasi.tanggal_akhir', 'reservasi.status', 'pelanggan.nama as pelanggan', 'mobil.nama as mobil')
        -> get();
        return new ResponsResource(true, 'Data Reservasi', $reservasi);
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
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|in:pending,canceled,completed',
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'mobil_id' => 'required|exists:mobil,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $reservasi = Reservasi::create([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'status' => $request->status,
            'pelanggan_id' => $request->pelanggan_id,
            'mobil_id' => $request->mobil_id    
        ]);
        return new ResponsResource(true, 'Berhasil Menambahkan Reservasi', $reservasi);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $reservasi = reservasi::select('tanggal_mulai', 'tanggal_akhir', 'status', 'pelanggan_id', 'mobil_id')
        -> where('reservasi.id', '=', $id)
        -> get();

        return new ResponsResource(true, 'Detail reservasi', $reservasi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|in:pending,cancel,complete',
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'mobil_id' => 'required|exists:mobil,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $reservasi = Reservasi::whereId($id)->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'status' => $request->status,
            'pelanggan_id' => $request->pelanggan_id,
            'mobil_id' => $request->mobil_id
        ]);
        return new ResponsResource(true, 'Berhasil Mengubah Data Reservasi', $reservasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $reservasi = Reservasi::whereId($id)->first();
        $reservasi->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data Reservasi', $reservasi);
    }
}
