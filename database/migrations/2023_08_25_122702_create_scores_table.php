<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id()->from(0);
            $table->foreignId('student_id')->constrained('student_subject', 'student_id');
            $table->foreignId('subject_id')->constrained('student_subject', 'subject_id');
            $table->double('practice_1');
            $table->double('practice_2');
            $table->double('practice_3');
            $table->double('practice_4');
            $table->double('daily_test_1');
            $table->double('daily_test_2');
            $table->double('midterm_test');
            $table->double('endterm_test');
            $table->double('final');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
};