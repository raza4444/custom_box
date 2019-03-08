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
            $table->integer('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_apartment')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_postcode')->nullable();
            $table->string('customer_country')->nullable();
            $table->text('order_notes')->nullable();
            $table->string('shipping_rate')->nullable();
            $table->string('total_price')->nullable();
            $table->string('price_currency')->nullable();
            $table->string('admin_product_comment')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('csr_name')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('order_status_id')->default('pending')->nullable();

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
