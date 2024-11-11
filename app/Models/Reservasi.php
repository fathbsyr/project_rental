<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    //
    protected $table = 'reservasi';
    protected $fillable = ['tanggal_mulai', 'tanggal_akhir', 'pelanggan_id', 'status', 'mobil_id'];
    public $timestamps = false;
}
