<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('studentId');
            $table->foreignId('user_id');
            $table->String('LRN', 12)->nullable();
            $table->string('student_fname', 45);
            $table->string('student_mname', 45)->nullable();
            $table->string('student_lname', 45);
            $table->string('student_gender');
            $table->string('student_civil');
            $table->date('student_birth');

            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('students_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('studentId');
            $table->string('street', 50);
            $table->string('barangay', 50);
            $table->string('city', 50);
            $table->string('province', 50);
            $table->string('student_motherfname', 50);
            $table->string('student_mothermname', 50)->nullable();
            $table->string('student_motherlname', 50);


            $table->foreign('studentId')->references('studentId')->on('students')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
