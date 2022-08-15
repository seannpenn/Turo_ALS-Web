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
        Schema::create('topic_content', function (Blueprint $table) {
            $table->increments('topic_content_id')->primary();
            $table->string('topic_type');
            
            $table->foreign('topic_content_id')->references('topic_id')->on('topics')->onDelete('cascade');
        });

        Schema::create('topic_link', function (Blueprint $table) {
            $table->unsignedInteger('topic_content_id');
            $table->unsignedInteger('linked_from');
            $table->string('topic_type');

            
            $table->foreign('topic_content_id')->references('topic_content_id')->on('topic_content')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_content');
    }
};
