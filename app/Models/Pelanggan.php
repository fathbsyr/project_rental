<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, Notifiable;
    //
    protected $table = 'pelanggan';
    protected $fillable = ['nama','nik', 'email', 'password', 'no_hp', 'alamat_lengkap'];
    public $timestamps = false;
    protected $hidden = ['password'];
}
