<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
 {

	public function up()
	{
		Schema::create('contacts', function (Blueprint $table) {
			$table->id();
			$table->string('email');
			$table->text('message');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('contacts');
	}
};
