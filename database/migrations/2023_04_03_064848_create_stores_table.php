<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
 {

	public function up()
	{
		Schema::create('stores', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('image');
			$table->boolean('include_vat')->default(0);
			$table->unsignedDecimal('vat_percentage')->nullable();
			$table->foreignId('user_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('stores');
	}
};
