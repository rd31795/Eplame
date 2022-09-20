<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeTestimonials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
           $table->integer('type')->default(1)->comment('1=>events and 2=> e-shop testimonial')->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            //
        });
    }
}
