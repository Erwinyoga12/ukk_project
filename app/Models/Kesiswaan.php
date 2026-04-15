<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesiswaan extends Model
{
    use HasFactory;

protected $fillable = [
        'nama',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
