<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Http\Resources\ResponsResource;
use DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::join('reservasi', 'pembayaran.reservasi_id', '=', 'reservasi.id')
            ->join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
            ->leftJoin('promosi', 'pembayaran.promosi_id', '=', 'promosi.id')
            ->leftJoin('denda', 'pembayaran.denda_id', '=', 'denda.id')
            ->select(
                'pembayaran.id',
                'pembayaran.metode',
                'pembayaran.tanggal_bayar',
                'pembayaran.total_bayar',
                'pembayaran.status',
                'pelanggan.nama as pelanggan',
                'promosi.diskon as diskon',
                'denda.keterangan as denda'
            )
            ->get();

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
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'metode' => 'required|string|max:50',
            'tanggal_bayar' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
            'status' => 'required|string|max:20',
            // 'reservasi_id' => 'required|date',  // Di sini tetap validasi tanggal
            'reservasi_id' => 'required|exists:reservasi,id',
            'promosi_id' => 'nullable|numeric',
            'denda_id' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan pembayaran dengan reservasi_id yang benar
        $pembayaran = Pembayaran::create([
            'metode' => $request->metode,
            'tanggal_bayar' => $request->tanggal_bayar,
            'total_bayar' => $request->total_bayar,
            'status' => $request->status,
            'reservasi_id' => $request->reservasi_id,
            'promosi_id' => $request->promosi_id,
            'denda_id' => $request->denda_id
        ]);

        return new ResponsResource(true, 'Data Pembayaran Berhasil Ditambahkan', $pembayaran);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembayaran = Pembayaran::join('reservasi', 'pembayaran.reservasi_id', '=', 'reservasi.id')
            ->join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
            ->join('promosi', 'pembayaran.promosi_id', '=', 'promosi.id')
            ->join('denda', 'pembayaran.denda_id', '=', 'denda.id')
            ->select('pembayaran.id', 'pembayaran.metode', 'pembayaran.tanggal_bayar',
                     'pembayaran.total_bayar', 'pembayaran.status', 'pelanggan.nama as pelanggan',
                     'promosi.diskon as diskon', 'denda.keterangan as denda')
            ->where('pembayaran.id', $id)
            ->get();

        if ($pembayaran) {
            return new ResponsResource(true, 'Detail Pembayaran', $pembayaran);
        } else {
            return new ResponsResource(false, 'Data Pembayaran Tidak Ditemukan', null);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaran = Pembayaran::join('reservasi', 'pembayaran.reservasi_id', '=', 'reservasi.id')
            ->join('pelanggan', 'reservasi.pelanggan_id', '=', 'pelanggan.id')
            ->join('promosi', 'pembayaran.promosi_id', '=', 'promosi.id')
            ->join('denda', 'pembayaran.denda_id', '=', 'denda.id')
            ->select('pembayaran.id', 'pembayaran.metode', 'pembayaran.tanggal_bayar',
                     'pembayaran.total_bayar', 'pembayaran.status', 'pelanggan.nama as pelanggan',
                     'promosi.diskon as diskon', 'denda.keterangan as denda')
            ->where('pembayaran.id', $id)
            ->get();

        if ($pembayaran) {
            return new ResponsResource(true, 'Detail Pembayaran', $pembayaran);
        } else {
            return new ResponsResource(false, 'Data Pembayaran Tidak Ditemukan', null);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'metode' => 'required|string|max:50',
            'tanggal_bayar' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
            'status' => 'required|string|max:20',
            'reservasi_id' => 'required|numeric:reservasi,id',
            // 'promosi_id' => 'nullable|numeric:promosi,id',
            // 'denda_id' => 'nullable|numeric:denda,id'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pembayaran = Pembayaran::whereId($id)->update([
            'metode' => $request->metode,
            'tanggal_bayar' => $request->tanggal_bayar,
            'total_bayar' => $request->total_bayar,
            'status' => $request->status,
            'reservasi_id' => $request->reservasi_id,
            'promosi_id' => $request->promosi_id,
            'denda_id' => $request->denda_id
        ]);
        return new ResponsResource(true, 'Data Pembayaran Berhasil Di Ubah', $pembayaran);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::whereId($id)->first();
        $pembayaran->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data Pembayaran', $pembayaran);
    }
}
