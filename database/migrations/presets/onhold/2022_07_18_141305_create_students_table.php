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
        Schema::create('student', function (Blueprint $table) {
            $table->integer('studid')->primary();
            $table->string('studfname', 45);
            $table->string('studmname', 45)->nullable();
            $table->string('studlname', 45);
            // $table->string('studprogram', 45);
            $table->integer('studprogramid');
            $table->integer('studcollegeid');
            $table->integer('studyear');

            $table->foreign('studprogramid')->references('prog_id')->on('programs');
            $table->foreign('studcollegeid')->references('coll_id')->on('colleges');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
};
