<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class School_class extends Model
{
    protected $table = 'school_classes';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name'
    ];

    public function students() {
        return $this->hasMany(Student::class, 'school_class_id', '_id');
    }
}