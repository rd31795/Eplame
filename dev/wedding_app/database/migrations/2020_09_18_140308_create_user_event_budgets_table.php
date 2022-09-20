<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('user_event_id');
            $table->integer('parent_catagory_id')->nullable();
            $table->integer('catagory_id')->nullable();
            $table->string('catagory_label');
            $table->double('estimated_budget')->default(0);
            $table->double('final_budget')->default(0);
            $table->double('paid_money')->default(0);
            $table->longtext('note')->nullable();
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
        Schema::dropIfExists('user_event_budgets');
    }
}
