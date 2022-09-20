<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCohostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_hosts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('host_id');
            $table->integer('cohost_id')->nullable();
            $table->string('cohost_name');
            $table->string('cohost_email');
            $table->string('relation');
            $table->integer('event_id');
            $table->boolean('event_sharing')->default(0)->nullable();
            $table->boolean('guest_management')->default(0)->nullable();
            $table->boolean('checklist_management')->default(0)->nullable();
            $table->boolean('budget_management')->default(0)->nullable();
            $table->boolean('event_management')->default(0)->nullable();
            $table->boolean('vendor_management')->default(0)->nullable();
            $table->boolean('status')->default(0)->nullable();
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
        Schema::dropIfExists('cohosts');
    }
}
