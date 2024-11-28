<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Http\Resources\ResponsResource;
use Illuminate\Support\Facades\Validator;
use DB;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $ulasan = DB::table('ulasan')->get();
        if (!auth('pelanggan')->check()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $ulasan = Ulasan::join('pelanggan', 'ulasan.pelanggan_id', '=', 'pelanggan.id')
        -> select('ulasan.id','ulasan.komentar', 'pelanggan.nama as pelanggan')
        -> get();
        return new ResponsResource(true, 'Data Ulasan', $ulasan);
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
            'komentar' => 'required',
            'pelanggan_id' => 'required|exists:pelanggan,id|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $ulasan = Ulasan::create([
           'komentar' => $request->komentar,
           'pelanggan_id' => $request->pelanggan_id
        ]);
        
        return new ResponsResource(true, 'Data Ulasan Berhasil Ditambahkan', $ulasan);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ulasan = Ulasan::join('pelanggan', 'ulasan.pelanggan_id', '=', 'pelanggan.id')
        -> select('ulasan.komentar', 'pelanggan.nama as pelanggan')
        -> where('ulasan.id', $id)
        -> get();
        return new ResponsResource(true, 'Data Ulasan', $ulasan);
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
            'komentar' => 'required',
            'pelanggan_id' => 'required|exists:pelanggan,id|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $ulasan = Ulasan::whereId($id)->update([
           'komentar' => $request->komentar,
           'pelanggan_id' => $request->pelanggan_id
        ]);
        
        return new ResponsResource(true, 'Data Ulasan Berhasil Diubah', $ulasan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ulasan = Ulasan::whereId($id)->first();
        $ulasan->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data Ulasan', $ulasan);
    }
}
