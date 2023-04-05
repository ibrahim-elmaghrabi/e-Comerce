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
			$table->enum('size', array('xs', 's', 'l', 'xl', '2xl', '3xl', '4xl', '5xl'));
			$table->unsignedDecimal('price');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('sizes');
	}
};
