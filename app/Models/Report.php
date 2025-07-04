<?php
// app/Models/PlantingActivity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'season',
    'step_name',
    'date',
    'description',
    'fertilizer_count',
    'fertilizer_type',
];


    protected $dates = ['date'];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
