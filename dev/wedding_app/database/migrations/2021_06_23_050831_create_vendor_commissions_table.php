<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->double('slab_from')->nullable();
            $table->double('slab_to')->nullable();
            $table->integer('commission_type')->nullable();
            $table->integer('amt_in_percent')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('vendor_commissions');
    }
}
