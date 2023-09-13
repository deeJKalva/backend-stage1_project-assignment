<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Student_subject extends Model
{
    public function score() {
        return $this->hasOne(Score::class, ['student_id', 'subject_id'], ['student_id', 'subject_id']);
    }
}