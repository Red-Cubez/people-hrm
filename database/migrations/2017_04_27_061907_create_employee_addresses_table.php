<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAddressesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('employee_addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('streetLine1')->nullable();
			$table->string('streetLine2')->nullable();
			$table->string('country')->nullable();
			$table->string('stateProvince')->nullable();
			$table->string('city')->nullable();
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('employee_addresses');
	}
}
