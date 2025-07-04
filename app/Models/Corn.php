<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corn extends Model
{
    protected $table = 'corns';

    protected $fillable = ['name', 'description', 'image'];
}

