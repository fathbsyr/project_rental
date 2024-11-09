<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
    protected $table = 'pelanggan';
    protected $fillable = ['nama','nik', 'email', 'password', 'no_hp', 'alamat_lengkap'];
}
