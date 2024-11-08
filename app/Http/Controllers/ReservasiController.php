<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Http\Resources\ResponsResource;
use DB;

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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
