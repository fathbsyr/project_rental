<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements CanResetPassword
{
    //
    use HasApiTokens, Notifiable;

    protected $table = 'admin';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $timestamps = false;
    protected $hidden = [
        'password',
    ];
}
