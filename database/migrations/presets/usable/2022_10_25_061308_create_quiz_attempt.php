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
        Schema::create('quiz_attempt', function (Blueprint $table) {
            $table->increments('attempt_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('quiz_id');
            $table->timestamps();

            $table->foreign('quiz_id')->references('quiz_id')->on('quiz')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_attempt');
    }
};
