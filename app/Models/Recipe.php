<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    protected $casts = [
        'ingredients' => 'array',
        'instructions' => 'array',
    ];




    use HasFactory;
}
