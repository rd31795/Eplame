<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductListHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_list_homes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Heading');
            $table->string('product-category');
            $table->boolean('view_all')->default(1)->comment('1=>show view all  and 2=> hide view all');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('product_list_homes');
    }
}
