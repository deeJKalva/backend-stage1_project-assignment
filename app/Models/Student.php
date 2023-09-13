<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = '_id';
    protected $fillable = [
        'school_class_name',
        'name',
        'date_of_birth',
        'registration_number'
    ];

    public function class() {
        return $this->belongsTo(School_class::class, 'school_class_id', '_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id')->withPivot('score_id')->withTimestamps();
    }
}