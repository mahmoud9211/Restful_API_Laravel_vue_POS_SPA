<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->integer('qty');
            $table->float('subtotal',8,2);
            $table->float('total',8,2);
            $table->float('vat');
            $table->string('payment_method');
            $table->float('pay',8,2);
            $table->float('due',8,2);
            $table->date('order_date');
            $table->string('order_month');
            $table->string('order_year');
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
