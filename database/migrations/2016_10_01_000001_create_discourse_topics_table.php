<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscourseTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discourse_topics', function (Blueprint $table) {
            $table->integer('forum_id')->unsigned();
            $table->integer('id')->unsigned()->primary();
            $table->string('title');
            $table->text('raw');
            $table->string('category');
            $table->foreign('forum_id')->references('id')->on('discourse_forums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discourse_topics');
    }
}
