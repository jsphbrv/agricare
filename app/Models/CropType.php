<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropType extends Model
{
    protected $fillable = ['name', 'description', 'image'];
}