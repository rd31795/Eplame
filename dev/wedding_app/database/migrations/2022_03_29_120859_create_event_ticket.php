<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('event_template_id');
            $table->string('font_color');
            $table->string('back_font_colour')->nullable();
            $table->string('background_image');
            $table->string('back_cover_background_picture')->nullable();
            $table->string('logo_color')->nullable();
            $table->string('template_text')->nullable();
            $table->string('template_backcover_text')->nullable();
            $table->string('header_content')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('ticket_right_side')->nullable();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('event_ticket');
    }
}
