<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantingActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'crop',           // <-- add this
        'variety',        // <-- add this
        'season',
        'step_name',
        'date',
        'description',
        'fertilizer_count',
        'fertilizer_type',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relationship to User (Farmer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
