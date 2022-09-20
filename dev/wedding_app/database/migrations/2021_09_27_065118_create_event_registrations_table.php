<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_event_id');
            $table->string('orderID');
            $table->double('amount');
            $table->string('payment_by');
            $table->integer('user_event_group_id');
            $table->integer('user_event_menu_id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->integer('age');
            $table->string('gender');
            $table->longText('balance_transaction');
            $table->longText('billing_address');
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
        Schema::dropIfExists('event_registrations');
    }
}
