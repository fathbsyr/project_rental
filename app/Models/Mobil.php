<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    //
    protected $table = 'mobil';
    protected $fillable = ['brand', 'nama', 'harga', 'ketersediaan', 'deskripsi'];
    public $timestamps = false;
}
