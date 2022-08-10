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
            $table->unsignedInteger('studentId')->primary();
            $table->foreignId('user_id');
            $table->String('LRN', 12)->nullable();
            $table->string('student_fname', 45);
            $table->string('student_mname', 45)->nullable();
            $table->string('student_lname', 45);
            $table->string('student_gender');
            $table->string('student_civil');
            $table->date('student_birth');
            $table->string('student_placeofbirth');
            $table->string('street', 50);
            $table->string('barangay', 50);
            $table->string('city', 50);
            $table->string('province', 50);
            $table->string('program_enrolled')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('studentId')->references('studentId')->on('enrollment')->onDelete('cascade');
        });

        Schema::create('student_family', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('studentId');
            $table->string('student_compfname', 50);
            $table->string('student_compmname', 50)->nullable();
            $table->string('student_complname', 50);

            $table->string('student_motherfname', 50);
            $table->string('student_mothermname', 50)->nullable();
            $table->string('student_motherlname', 50);


            $table->foreign('studentId')->references('studentId')->on('students')->onDelete('cascade');
        });

        Schema::create('student_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('studentId');
            $table->string('last_level', 50);
            $table->string('student_reason', 200);
            $table->string('answer_type', 20);
            $table->string('program_attended', 50)->nullable();
            $table->string('program_literacy', 50)->nullable();
            $table->string('program_attended_year', 50)->nullable();
            
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
