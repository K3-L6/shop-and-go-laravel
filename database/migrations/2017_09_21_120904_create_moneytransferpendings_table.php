<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneytransferpendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneytransferpendings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('moneytransfer_id')->unsigned();
            $table->foreign('moneytransfer_id')->references('id')->on('moneytransfers')->onDelete('cascade');
            $table->string('sendername');
            $table->decimal('ammountsent', 10, 2);
            $table->string('controlnumber');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneytransferpendings');
    }
}
