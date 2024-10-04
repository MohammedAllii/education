<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'parent_name',
        'parent_phone',
        'parent_email',
        'enrollment_date',
        'class_id',
        'status',
        'avatar',
        'medical_notes'
    ];


    public function class()
    {
        return $this->belongsTo(Classe::class);
    }


}










