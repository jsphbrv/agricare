<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pest extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name',
        'scientific_name',
        'crop',
        'pesticide_id',
        'image',
    ];

    // If you have a Pesticide model
    public function pesticide()
    {
        return $this->belongsTo(Pesticide::class);
    }
}

