<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('event');
            $table->integer('user_id');            
            $table->integer('style_id')->nullable()->default(0);            
            $table->string('style_image')->nullable();
            $table->string('style_title')->nullable();
            $table->LongText('style_description')->nullable();
            $table->string('title');
            $table->LongText('description');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('event_type');
            $table->string('min_person');
            $table->string('max_person');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('user_events');
    }
}
