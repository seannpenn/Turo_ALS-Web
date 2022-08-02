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
        Schema::create('Topics', function (Blueprint $table) {
            $table->increments('topic_id');
            $table->unsignedInteger('content_id');
            $table->string('topic_title');
            $table->string('topic_description')->nullable();
            $table->string('topic_type');

            $table->foreign('content_id')->references('content_id')->on('coursecontent')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Topics');
    }
};
