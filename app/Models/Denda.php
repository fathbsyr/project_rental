<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    //
    protected $table = 'denda';
    protected $fillable = ['keterangan', 'reservasi_id'];
    public $timestamps = false;
}
