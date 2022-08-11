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
        Schema::create('enrollment', function (Blueprint $table) {
            $table->unsignedInteger('student_id')->primary();
            $table->unsignedInteger('prog_id');
            $table->unsignedInteger('loc_id');
            $table->string('status')->default('pending');

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('loc_id')->references('loc_id')->on('learning_center')->onDelete('cascade');
            $table->foreign('prog_id')->references('prog_id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollment');
    }
};
