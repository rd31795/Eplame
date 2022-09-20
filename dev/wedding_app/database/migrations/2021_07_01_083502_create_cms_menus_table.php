<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_type');
            $table->integer('cms_id');
            $table->string('custom_name');
            $table->string('custom_url');
            $table->string('slug');
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
        Schema::dropIfExists('cms_menus');
    }
}
