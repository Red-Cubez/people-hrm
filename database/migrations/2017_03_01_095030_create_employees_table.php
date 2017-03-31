<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('employees', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();

			$table->string('firstName');
			$table->string('lastName');
			$table->date('hireDate');
			$table->date('terminationDate');
			$table->string('jobTitle');
			$table->decimal('annualSalary', 15, 2);
			$table->decimal('hourlyRate', 15, 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('employees');
	}
}
