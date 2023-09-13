<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->foreignId('school_class_id')->constrained('school_classes', '_id');
            // $table->string('school_class_name');
            $table->string('name');
            $table->string('date_of_birth');
            $table->integer('registration_number')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};