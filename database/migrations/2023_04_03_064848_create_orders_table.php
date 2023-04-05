<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id');
			$table->unsignedDecimal('total');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('orders');
	}
};
