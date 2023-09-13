<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_subject', function (Blueprint $table) {
            $table->id()->from(0);
            $table->foreignId('student_id')->constrained('students', '_id');
            $table->foreignId('subject_id')->constrained('subjects', '_id');
            $table->foreignId('score_id')->constrained('scores', '_id');
            $table->primary(['student_id', 'subject_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_subject');
    }
};