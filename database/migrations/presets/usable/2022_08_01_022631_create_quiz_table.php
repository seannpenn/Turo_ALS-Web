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
        Schema::create('quiz', function (Blueprint $table) {
            $table->increments('quiz_id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('teacher_id');
            $table->String('quiz_title');
            $table->String('start_date')->nullable();
            $table->String('end_date')->nullable();
            $table->String('start_time')->nullable();
            $table->String('end_time')->nullable();
            $table->integer('attempts')->default(1);
            $table->String('status')->default('inactive');
            $table->integer('duration')->nullable();
            $table->boolean('releaseGrades')->default(false);
            $table->String('password')->nullable();


            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
};
