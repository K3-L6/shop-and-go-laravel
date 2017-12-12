<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('email');
            $table->string('mobilenumber');
            $table->string('province');
            $table->string('address');
            $table->double('shipping_fee', 10, 2);
            $table->double('total', 10, 2);
            $table->string('purchase_type', 50);
            $table->string('status', 50);
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
        Schema::dropIfExists('orders');
    }
}
