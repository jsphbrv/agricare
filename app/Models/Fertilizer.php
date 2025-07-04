<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fertilizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'crop',
        'type',
        'nutrient_content',
        'image',
    ];
}
