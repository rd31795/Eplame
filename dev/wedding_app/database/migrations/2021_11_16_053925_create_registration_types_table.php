<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('reg_type');
            $table->string('price');
            $table->longText('description');
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
        Schema::dropIfExists('registration_types');
    }
}
