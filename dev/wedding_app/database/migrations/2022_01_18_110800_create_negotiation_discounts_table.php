<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegotiationDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiation_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->integer('product_id');
            $table->boolean('type')->default(1)->comment('0=>percentage and 1=>amount');
            $table->string('coupon')->unique();
            $table->string('email');
            $table->boolean('is_active')->default(1)->comment('1=>active and 0=>in_active');
            $table->boolean('is_used')->default(0)->comment('1=> is_used and 0=> not_used');
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
        Schema::dropIfExists('negotiation_discounts');
    }
}
