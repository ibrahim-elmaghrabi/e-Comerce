<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{

	public function up()
	{
		Schema::create('images', function (Blueprint $table) {
			$table->id();
			$table->string('image');
			$table->foreignId('product_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('images');
	}
};
