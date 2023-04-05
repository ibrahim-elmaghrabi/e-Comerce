<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{

	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->foreignId('parent_id')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('categories');
	}
};
