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
            $table->foreignId('address_id');
			$table->unsignedDecimal('total')->default(0);
            $table->enum('status', ['pending', 'charged', 'delivered'])->default('pending');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('orders');
	}
};
