<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function techologies() {
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }

    public function positions() {
        return $this->belongsToMany(Position::class)->withTimestamps();
    }

    public function projects() {
        return $this->belongsToMany(Project::class)->withPivot('project_employee_hours');
    }
}
