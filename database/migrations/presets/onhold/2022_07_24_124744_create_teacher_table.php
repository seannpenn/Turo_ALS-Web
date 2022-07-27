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
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacherId');
            $table->foreignId('user_id')->nullable();
            $table->string('teacher_fname', 45);
            $table->string('teacher_mname', 45)->nullable();
            $table->string('teacher_lname', 45);
            $table->string('teacher_number', 45)->nullable();
            $table->date('teacher_birth');
            $table->rememberToken();


            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
