<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{

	public function up()
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->enum('rate', array('1', '2', '3', '4', '5'));
			$table->text('comment');
			$table->foreignId('user_id');
			$table->foreignId('product_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('comments');
	}
};
