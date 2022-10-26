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
        Schema::create('question', function (Blueprint $table) {
            $table->increments('question_id');
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('type')->default(1);
            $table->String('question');
            $table->integer('points')->default(1);

            $table->foreign('quiz_id')->references('quiz_id')->on('quiz')->onDelete('cascade');
            $table->foreign('type')->references('type_id')->on('question_type');

        });
        Schema::create('option', function (Blueprint $table) {
            $table->increments('option_id');
            $table->unsignedInteger('question_id');
            $table->String('option');
            $table->boolean('isCorrect')->default(false);
            
            $table->foreign('question_id')->references('question_id')->on('question')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
