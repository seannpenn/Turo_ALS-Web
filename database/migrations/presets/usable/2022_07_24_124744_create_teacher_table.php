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
            $table->increments('teacher_id');
            $table->foreignId('user_id')->nullable();
            $table->integer('prog_id');
            $table->integer('loc_id');
            $table->string('teacher_fname', 45);
            $table->string('teacher_mname', 45)->nullable();
            $table->string('teacher_lname', 45);
            $table->string('teacher_number', 45)->nullable();
            $table->date('teacher_birth');
            $table->rememberToken();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
