<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePackageProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_package_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->integer('status')->default(1)->comment('0=> package_expired ,1=> is active ,2=> package usage closed for somereason');
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
        Schema::dropIfExists('purchase_package_product');
    }
}
