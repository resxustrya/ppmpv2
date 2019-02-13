<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Section extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('section', function (Blueprint $table) {
			$table->increments('id');
			$table->string('short')->nullable();
			$table->integer('division');
			$table->string('description');
			$table->integer('head');
			$table->string('code');
			$table->double('current_budget');
			$table->string('source_fund');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('section');
	}

}
