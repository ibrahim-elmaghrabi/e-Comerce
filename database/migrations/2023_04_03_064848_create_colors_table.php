<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
 {

	public function up()
	{
		Schema::create('colors', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('colors');
	}
};
