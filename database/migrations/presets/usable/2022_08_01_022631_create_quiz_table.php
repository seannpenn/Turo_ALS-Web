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
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->integer('attempts')->default(0);
            $table->String('status')->default('active');
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
