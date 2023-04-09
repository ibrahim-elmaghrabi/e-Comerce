<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{

	public function up()
	{
		Schema::create('order_product', function (Blueprint $table) {
			$table->id();
			$table->foreignId('order_id') ;
			$table->foreignId('product_id') ;
            $table->foreignId('size_id');
            $table->foreignId('color_id');
			$table->unsignedDecimal('price');
			$table->integer('quantity');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('order_product');
	}
};
