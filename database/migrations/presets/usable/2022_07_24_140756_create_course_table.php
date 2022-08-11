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
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('course_id');
            $table->unsignedInteger('teacher_id');
            $table->string('course_title', 100);
            $table->string('course_description', 200);
            
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });

        Schema::create('coursecontent', function (Blueprint $table) {
            $table->increments('content_id');
            $table->unsignedInteger('course_id');
            $table->string('content_title', 100);
            $table->string('content_description', 200);
            
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('coursecontent');
    }
};
