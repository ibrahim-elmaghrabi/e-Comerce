<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
 {

	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description');
			$table->string('tax_number');
			$table->foreignId('user_id') ;
			$table->foreignId('category_id') ;
            $table->foreignId('store-id') ;
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('products');
	}
};
