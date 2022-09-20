<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('deal_code')->nullable();
            $table->integer('deal_life')->nullable();
            $table->integer('deal_off_type')->nullable();
            $table->string('amount')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
