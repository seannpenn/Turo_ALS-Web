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
        Schema::create('students_background', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentId');
            $table->string('last_level', 50);
            $table->string('program_attended', 50)->nullable();
            $table->string('program_literacy', 50)->nullable();
            $table->string('program_attended_year', 50)->nullable();
            
            $table->foreign('studentId')->references('studentId')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_background');
    }
};
