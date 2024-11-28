<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Authenticatable
{
    use HasApiTokens;
    //
    protected $table = 'pelanggan';
    protected $fillable = ['nama','nik', 'email', 'password', 'no_hp', 'alamat_lengkap'];
    public $timestamps = false;
}
