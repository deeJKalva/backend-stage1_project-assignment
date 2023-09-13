<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = '_id';
    protected $fillable = [
        'school_class_name',
        'name'
    ];
    protected $casts = [
        'teacher_name'
    ];

    public function students() {
        return $this->belongsToMany(Student::class, 'student_subject', 'subject_id', 'student_id')->withPivot('score_id')->withTimestamps();
    }
}