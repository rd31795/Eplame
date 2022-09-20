<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_disputes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('raised_by');
            $table->integer('business_id');
             $table->integer('raised_to');
            $table->integer('vendor_id');
            $table->integer('order_id');
            $table->string('reason');
            $table->string('otherReason');
            $table->string('solution');
            $table->integer('amount');
            $table->integer('vendor_amount');
            $table->integer('admin_open_status');
            $table->integer('admin_status')->nullable();
            $table->integer('dispute_status')->nullable()->default(1);
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
        Schema::dropIfExists('user_disputes');
    }
}
