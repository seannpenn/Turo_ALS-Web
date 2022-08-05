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
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->unsignedInteger('quiz_id');
            $table->String('question');
            $table->String('choice_a')->nullable();
            $table->String('choice_b')->nullable();
            $table->String('choice_c')->nullable();
            $table->String('choice_d')->nullable();
            $table->String('answer')->nullable();

            
            $table->foreign('quiz_id')->references('quiz_id')->on('quiz')->onDelete('cascade');

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
