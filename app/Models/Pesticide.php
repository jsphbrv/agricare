<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Add this


class Pesticide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'crop',
        'used_for',
        'active_ingredient',
        'description',
        'image',
    ];
}