<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function techonologies() {
        return $this->belongsToMany(Techonology::class)->withTimestamps();
    }

    public function employees() {
        return $this->belongsToMany(Employee:class)->withTimestaps();
    }
}
