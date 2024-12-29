<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\ResponsResource;
use DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brand = Brand::all();
        return new ResponsResource(true, 'Data Brand', $brand);
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
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $brand = Brand::create([
            'name' => $request->name,
        ]);

        return new ResponsResource(true, 'Data Brand Berhasil Ditambahkan', $brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $mobil = Brand::select('name')
        ->where('brand.id', '=', $id)
        ->get();

        return new ResponsResource(true, 'Data Mobil', $mobil);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $mobil = Brand::select('name')
        ->where('brand.id', '=', $id)
        ->get();

        return new ResponsResource(true, 'Data Mobil', $mobil);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $brand = Brand::whereId($id)->update([
            'name' => $request->name
        ]);
        
        return new ResponsResource(true, 'Data Brand Berhasil Diubah', $brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand = Brand::whereId($id)->first();
        $brand->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data Brand', $brand);
    }
}
