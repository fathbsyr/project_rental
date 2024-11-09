<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['metode', 'tanggal_bayar', 'total_bayar', 'status', 'reservasi_id', 'promosi_id', 'denda_id'];
}
