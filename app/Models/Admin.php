<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    //
    use HasApiTokens;

    protected $table = 'admin';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $timestamps = false;
    protected $hidden = [
        'password',
    ];
}
