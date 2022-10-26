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
        Schema::create('quiz_summary', function (Blueprint $table) {
            $table->increments('quiz_summary_id');
            $table->unsignedInteger('attempt_id');
            $table->integer('total_score')->default(0);

            $table->foreign('attempt_id')->references('attempt_id')->on('quiz_attempt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_summary');
    }
};
