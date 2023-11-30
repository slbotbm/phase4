<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    public function employees() {
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }

    public function projects() {
        return $this->belongsToMany(Project::Class)->withTimestamps();
    }
}
