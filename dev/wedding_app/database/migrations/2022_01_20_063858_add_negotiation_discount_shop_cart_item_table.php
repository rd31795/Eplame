<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNegotiationDiscountShopCartItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_cart_items', function (Blueprint $table) {
            $table->double('discount_price')->default(0);
            $table->double('total_discount')->default(0);
            $table->boolean('discount_type')->nullable()->comment('0=>percentage and 1=>amount');
            $table->double('discount_amount')->default(0)->comment('It will be in percentage and direct amount based on the discount_type ');
            $table->integer('negotiation_discounts_id')->default(0)->comment('0=> no negotiation discount coupon used');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_cart_items', function (Blueprint $table) {
            //
        });
    }
}
