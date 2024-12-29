<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    //
    protected $table = 'mobil';
    protected $fillable = ['brand_id', 'nama', 'harga', 'ketersediaan', 'deskripsi'];
    public $timestamps = false;
}
