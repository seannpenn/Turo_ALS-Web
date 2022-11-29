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
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->increments('quiz_answer_id');
            $table->unsignedInteger('attempt_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('option_id')->nullable();
            $table->integer('isCorrect')->nullable();
            $table->longText('textAnswer')->nullable();
            $table->integer('points')->nullable();
            
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('attempt_id')->references('attempt_id')->on('quiz_attempt')->onDelete('cascade');
            $table->foreign('question_id')->references('question_id')->on('question')->onDelete('cascade');
            $table->foreign('option_id')->references('option_id')->on('option')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_answers');
    }
};
