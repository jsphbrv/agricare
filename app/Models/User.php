<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

protected $fillable = [
    'first_name', 'middle_name', 'last_name', 'suffix', 'name', 'gender',
    'rsbsa_ref_no', 'id_number', 'id_name', 'total_farm_area',
    'perm_address_street', 'perm_address_line2', 'perm_address_barangay', 'perm_city', 'perm_province',
    'address', 'birthdate', 'birthplace', 'nationality', 'profession',
    'source_of_funds', 'mothers_maiden_name', 'emboss_name',
    'religion', 'civil_status', 'name_of_spouse', 'highest_formal_education',
    'mobile_number', 'email', 'password', 'role', 'status'
];




    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    // app/Models/User.php
public function plantingActivities()
{
    return $this->hasMany(PlantingActivity::class, 'user_id');
}


}
