<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Http\Resources\ResponsResource;
use DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pembayaran = DB::table('pembayaran')->get();
        $pembayaran = Pembayaran::join('reservasi', 'pembayaran.reservasi_id', '=', 'reservasi.id') 
        -> join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
        -> join('promosi', 'pembayaran.promosi_id', '=', 'promosi.id')
        -> join('denda', 'pembayaran.denda_id', '=', 'denda.id')
        -> select('pembayaran.id', 'pembayaran.metode',
            'pembayaran.tanggal_bayar', 'total_bayar',
            'pembayaran.status', 'pelanggan.nama as pelanggan',
            'promosi.diskon as diskon',
            'denda.keterangan as denda'
        )
        -> get();
        return new ResponsResource(true, 'Data Pembayaran', $pembayaran);
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
