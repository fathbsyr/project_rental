<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    //
    protected $table = 'ulasan';
    protected $fillable = ['komentar', 'pelanggan_id'];
    public $timestamps = false;
}
