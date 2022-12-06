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
        Schema::create('assignment', function (Blueprint $table) {
            $table->increments('assignment_id');
            $table->unsignedInteger('course_id');
            $table->String('assignment_title', 200);
            $table->text('assignment_description');
            $table->String('start_date')->nullable();
            $table->String('end_date')->nullable();
            $table->String('start_time')->nullable();
            $table->String('end_time')->nullable();
            $table->unsignedInteger('submission_type')->nullable();
            $table->String('status')->default('inactive');
            
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->foreign('submission_type')->references('type_id')->on('submission_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment');
    }
};
