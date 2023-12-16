<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_name'
    ];

    public function employees() {
        return $this->belongsToMany(Employee::class)->withPivot('employee_position_start_date');
    }
}
