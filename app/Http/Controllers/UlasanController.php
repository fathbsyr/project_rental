<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Http\Resources\ResponsResource;
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
        $ulasan = Ulasan::join('pelanggan', 'ulasan.pelanggan_id', '=', 'pelanggan.id')
        -> select('ulasan.id', 'ulasan.komentar', 'pelanggan.nama as pelanggan')
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
