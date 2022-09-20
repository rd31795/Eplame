<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number')->nullable();            
            $table->boolean('payment_type')->nullable(); 
            $table->string('paypal_account')->nullable(); 
            $table->string('stripe_account')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('user_location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->tinyInteger('vendor_status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('password');
            $table->boolean('status')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
