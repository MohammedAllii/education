<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'class_id',
        'teacher_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function class()
    {
        return $this->belongsTo(Classe::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
