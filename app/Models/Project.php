<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'customer_name',
        'details',
        'start_date',
        'end_date',
        'hours_required_per_month',
        'cost'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function technologies() {
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }

    public function employees() {
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }
}
