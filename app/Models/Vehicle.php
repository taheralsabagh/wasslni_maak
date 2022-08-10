<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'max_passengers',
        'min_price',
        'kilometer_price',
        'instructions',
        'created_at',
        'updated_at',
    ];
    protected $hidden =
    [
        'created_at',
        'updated_at',
    ];
}
