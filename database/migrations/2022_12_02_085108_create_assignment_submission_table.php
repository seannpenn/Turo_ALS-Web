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
        Schema::create('assignment_submission', function (Blueprint $table) {
            $table->increments('submission_id');
            $table->unsignedInteger('assignment_id');
            $table->unsignedInteger('student_id');
            $table->integer('submission_type');

            $table->timestamps();
            $table->integer('total_score')->default(0);
            $table->integer('total_points')->default(0);

            $table->foreign('assignment_id')->references('assignment_id')->on('assignment')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });

        Schema::create('assignment_submission_text', function (Blueprint $table) {
            $table->increments('submission_text_id');
            $table->unsignedInteger('submission_id');
            $table->text('text');

            $table->foreign('submission_id')->references('submission_id')->on('assignment_submission')->onDelete('cascade');
        });

        Schema::create('assignment_submission_file', function (Blueprint $table) {
            $table->increments('submission_file_id');
            $table->unsignedInteger('submission_id');
            $table->text('path');

            $table->foreign('submission_id')->references('submission_id')->on('assignment_submission')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_submission');
    }
};
