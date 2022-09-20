<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRescheduleEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reschedule_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('user_id');
            $table->integer('vendor_category_id');
            $table->integer('category_id');
            $table->boolean('vendor_count')->default(0);
            $table->boolean('reshedule_request')->default(0);
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
        Schema::dropIfExists('reschedule_events');
    }
}
