<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;
use App\Http\Resources\ResponsResource;
use Illuminate\Support\Facades\Validator;
use DB;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResponsResource
    {
        //
        // $denda = DB::table('denda')->get();
        $denda = Denda::join('reservasi', 'denda.reservasi_id', '=', 'reservasi.id')
        -> join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
        -> select('denda.id', 'denda.keterangan', 'pelanggan.nama as pelanggan')
        -> get();
        return new ResponsResource(true, 'Data Denda', $denda);
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
            'reservasi_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        
        $denda = Denda::create([
            'keterangan' => $request->keterangan,
            'reservasi_id' => $request->reservasi_id,
        ]);
        return new ResponsResource(true, 'berhasil menambahkan data denda', $denda);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $denda = Denda::join('reservasi', 'denda.reservasi_id', '=', 'reservasi.id')
    -> join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
    -> select('denda.id', 'denda.keterangan', 'pelanggan.nama as pelanggan')
    -> where('denda.id', $id)
    -> get();
        return new ResponsResource(true, 'Detail data denda', $denda);
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