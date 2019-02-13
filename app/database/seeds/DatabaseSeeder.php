<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		

		$this->call('SectionSeeder');
		$this->call('ItemsTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PPMPCodeTableSeeder');
		$this->call('UnitsTableSeeder');
		$this->call('DivisionTableSeeder');
		$this->call('VenuesTableSeeder');
	}
}