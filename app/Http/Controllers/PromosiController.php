<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promosi;
use App\http\Resources\ResponsResource;
use Illuminate\Support\Facades\Validator;
use DB;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $promosi = DB::table('promosi')->get();
        $promosi = Promosi::join('mobil', 'promosi.mobil_id', '=', 'mobil.id')
        -> select('promosi.*', 'mobil.nama as mobil')
        -> get(); 
        return new ResponsResource(true, 'Data Promosi', $promosi);
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
        'diskon' => 'required|regex:/^\d+(\.\d+)?$/',
        'mobil_id' => 'required|integer',
       ]);
       if ($validator->fails()) {
        return response()->json($validator->errors(),422);
       }

        $promosi = Promosi::create([
            'diskon' => $request->diskon,
            'mobil_id' => $request->mobil_id,
        ]);
        return new ResponsResource(true, 'Data Promosi Berhasil Ditambahkan', $promosi);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $promosi = Promosi::join('mobil', 'promosi.mobil_id', '=', 'mobil.id')
        -> select('promosi.id', 'promosi.diskon', 'mobil.nama as mobil')
        -> where('promosi.id', $id)
        -> get(); 
        return new ResponsResource(true, 'Data Promosi', $promosi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $promosi = Promosi::join('mobil', 'promosi.mobil_id', '=', 'mobil.id')
        -> select('promosi.id', 'promosi.diskon', 'promosi.mobil_id', 'mobil.nama')
        -> where('promosi.id', $id)
        -> get(); 
        return new ResponsResource(true, 'Data Promosi', $promosi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'diskon' => 'required|regex:/^\d+(\.\d+)?$/',
            'mobil_id' => 'required|integer',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $promosi = Promosi::whereId($id)->update([
            'diskon' => $request->diskon,
            'mobil_id' => $request->mobil_id,
        ]);
        
        return new ResponsResource(true, 'Berhasil Mengubah Data Pomosi', $promosi);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $promosi = promosi::whereId($id)->first();
        $promosi->delete();
        return new ResponsResource(true, 'Berhasil Menghapus Data promosi', $promosi);
    }
}