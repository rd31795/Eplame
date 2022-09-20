<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('event_id');
            $table->integer('vendor_category_id');
            $table->integer('rating');
            $table->string('title');
            $table->text('summary');
            $table->longtext('images')->nullable();
            $table->integer('admin_approval')->nullable()->default(0);
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
        Schema::dropIfExists('business_reviews');
    }
}
