<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
    protected $primaryKey = '_id';
    protected $fillable = [
        'student_registration_number',
        'practice_1',
        'practice_2',
        'practice_3',
        'practice_4',
        'daily_test_1',
        'daily_test_2',
        'midterm_test',
        'endterm_test',
        'final'
    ];

    public function student_subject() {
        return $this->belongsTo(Student_subject::class, ['student_id', 'subject_id'], ['student_id', 'subject_id']);
    }
}