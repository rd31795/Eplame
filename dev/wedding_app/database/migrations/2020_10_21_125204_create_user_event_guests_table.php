<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event_guests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('user_event_id');
            $table->integer('user_event_group_id');
            $table->integer('user_event_menu_id');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->integer('age')->nullable();
            $table->string('email');
            $table->integer('attendance');
            $table->string('contact_no');
            $table->string('gender');

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
        Schema::dropIfExists('user_event_guests');
    }
}
