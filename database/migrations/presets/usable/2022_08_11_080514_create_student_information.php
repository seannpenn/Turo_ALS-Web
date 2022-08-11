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
        Schema::create('student_information', function (Blueprint $table) {
            $table->unsignedInteger('student_id')->primary();
            $table->String('LRN', 12)->nullable();
            $table->string('student_gender');
            $table->string('student_civil');
            $table->date('student_birth');
            $table->string('student_placeofbirth');
            $table->string('street', 50);
            $table->string('barangay', 50);
            $table->string('city', 50);
            $table->string('province', 50);

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });

        Schema::create('student_family', function (Blueprint $table) {
            $table->unsignedInteger('student_id')->primary();
            $table->string('student_compfname', 50);
            $table->string('student_compmname', 50)->nullable();
            $table->string('student_complname', 50);

            $table->string('student_motherfname', 50);
            $table->string('student_mothermname', 50)->nullable();
            $table->string('student_motherlname', 50);


            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });

        Schema::create('student_education', function (Blueprint $table) {
            $table->unsignedInteger('student_id')->primary();
            $table->string('last_level', 50);
            $table->string('student_reason', 200);
            $table->string('answer_type', 20);
            $table->string('program_attended', 50)->nullable();
            $table->string('program_literacy', 50)->nullable();
            $table->string('program_attended_year', 50)->nullable();
            
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_information');
    }
};
