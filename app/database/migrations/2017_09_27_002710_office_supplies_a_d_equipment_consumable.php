<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OfficeSuppliesADEquipmentConsumable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_d',function($table){
			
			$table->string('code')->nullable();
			$table->string('ppcode')->nullable();
			$table->string('item')->nullable();
			$table->string('unit')->nullable();

            $table->integer('q1_qty')->nullable();
			$table->integer('q2_qty')->nullable();
			$table->integer('q3_qty')->nullable();
			$table->integer('q4_qty')->nullable();

			$table->double('q1_amt',15,2)->nullable();
			$table->double('q2_amt',15,2)->nullable();
			$table->double('q3_amt',15,2)->nullable();
			$table->double('q4_amt',15,2)->nullable();
			

			$table->timestamp('date_added');
			$table->string('division');
			$table->string('created_by');
			$table->string('added_by')->nullable();
			$table->primary(array('item','created_by'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('table_d');
	}

}
