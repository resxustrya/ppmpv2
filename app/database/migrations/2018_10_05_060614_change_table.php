<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('table_a',function($table){
			$table->integer('year');
		});
		Schema::table('table_b',function($table){
			$table->integer('year');
		});
		Schema::table('table_c',function($table){
			$table->integer('year');
		});
		Schema::table('table_d',function($table){
			$table->integer('year');
		});
		Schema::table('table_e',function($table){
			$table->integer('year');
		});
		Schema::table('table_f',function($table){
			$table->integer('year');
		});
		Schema::table('table_g',function($table){
			$table->integer('year');
		});
		Schema::table('table_z',function($table){
			$table->integer('year');
		});
		Schema::table('program_name',function($table){
			$table->integer('year');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('table_a',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_b',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_c',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_d',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_e',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_f',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_g',function($table){
			$table->dropColumn('year');
		});
		Schema::table('table_z',function($table){
			$table->dropColumn('year');
		});
		Schema::table('program_name',function($table){
			$table->dropColumn('year');
		});
	}
}
