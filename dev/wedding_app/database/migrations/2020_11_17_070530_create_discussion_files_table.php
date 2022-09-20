<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('group_id');
            $table->string('title');
            $table->string('slug');
            $table->string('path');
            $table->longText('description');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion_files');
    }
}
