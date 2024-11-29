<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponsResource;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = DB::table('pelanggan')->get();
        return new ResponsResource(True, 'Data Pelanggan', $pelanggan);
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
            'nama' =>'required|string|max:255',
            'nik' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:pelanggan',
            'password' => 'nullable|min:8',
            'no_hp' =>'required|string|max:255',
            'alamat_lengkap' =>'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pelanggan = Pelanggan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap
        ]);
        return new ResponsResource(true, 'Berhasil Menambahkan Pelanggan', $pelanggan);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pelanggan = Pelanggan::select('nama','nik', 'email', 'password', 'no_hp', 'alamat_lengkap')
        -> where('pelanggan.id', '=', $id)
        -> get();

        return new ResponsResource(true, 'Detail Pelanggan', $pelanggan);
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
            'nama' =>'required|string|max:255',
            'nik' =>'required|string|max:255',
            'password' => 'nullable|min:8',
            'no_hp' =>'required|string|max:255',
            'alamat_lengkap' =>'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pelanggan = Pelanggan::whereId($id)->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap
        ]);
        return new ResponsResource(true, 'Berhasil Mengubah Data Pelanggan', $pelanggan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pelanggan = Pelanggan::whereId($id)->first();
        $pelanggan->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data Pelanggan', $pelanggan);
    }
}
