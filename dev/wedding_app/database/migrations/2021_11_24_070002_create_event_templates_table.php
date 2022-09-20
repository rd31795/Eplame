<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('template_id');
            $table->integer('template_name');
            $table->string('font_color');
            $table->string('background_image');
            $table->tinyInteger('status')->default('1'); 
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
        Schema::dropIfExists('event_templates');
    }
}
