<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_in_items', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_in_id');
            $table->integer('product_id');
            $table->integer('qty');
            $table->double('purchase_price',10,2)->nullable()->default(null);
            $table->date('expiry_date')->nullable()->default(null);
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
        Schema::dropIfExists('stock_in_items');
    }
}
