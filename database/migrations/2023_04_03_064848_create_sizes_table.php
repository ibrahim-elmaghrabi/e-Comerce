<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
 {

	public function up()
	{
		Schema::create('sizes', function (Blueprint $table) {
			$table->id();
			$table->foreignId('product_id');
			$table->string('size');
			$table->unsignedDecimal('price');
            $table->unsignedInteger('quantity');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('sizes');
	}
};
