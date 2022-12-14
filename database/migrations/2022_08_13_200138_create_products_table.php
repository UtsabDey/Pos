<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('product_code')->nullable();
            $table->text('barcode')->nullable();
            $table->text('qrcode')->nullable();
            $table->text('product_image')->nullable();
            $table->integer('alert_stock')->default('100');
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
        Schema::dropIfExists('products');
    }
}
