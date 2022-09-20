<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('phone_number');
            $table->string('address');
            $table->string('address_2');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zipcode');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('country_code')->nullable();
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
        Schema::dropIfExists('shipping_addresses');
    }
}
