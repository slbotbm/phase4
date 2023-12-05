<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'sex',
        'start_of_employment',
        'profile_url',
        'still_working'
    ];


    protected $casts = [
        'start_of_employment' => 'datetime',
        'still_working' => 'boolean',
    ];

    public function technologies() {
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }

    public function positions() {
        return $this->belongsToMany(Position::class)->withTimestamps();
    }

    public function projects() {
        return $this->belongsToMany(Project::class)->withPivot('project_employee_hours');
    }
}
