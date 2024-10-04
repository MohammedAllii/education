<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'date',
        'duration',
        'total_marks',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
}

