<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    //
    protected $table = 'ulasan';
    protected $fillable = ['komentar', 'user_id'];
}
