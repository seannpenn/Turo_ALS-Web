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
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('topic_id');
            $table->unsignedInteger('content_id');
            $table->string('topic_title')->nullable();
            $table->string('topic_description')->nullable();

            $table->foreign('content_id')->references('content_id')->on('coursecontent')->onDelete('cascade');
        });

        Schema::create('topic_content', function (Blueprint $table) {
            $table->increments('topic_content_id');
            $table->unsignedInteger('topic_id');
            $table->string('topic_content_title');
            $table->string('type');
            $table->longText('html')->nullable();
            $table->longText('file')->nullable();
            $table->integer('link')->nullable();
            

            $table->foreign('topic_id')->references('topic_id')->on('topics')->onDelete('cascade');
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
