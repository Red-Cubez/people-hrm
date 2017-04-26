<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAddressesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('company_addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('streetLine1')->nullable();
			$table->string('streetLine2')->nullable();
			$table->string('country')->nullable();
			$table->string('stateProvince')->nullable();
			$table->string('city')->nullable();
			$table->integer('company_id')->unsigned();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('company_addresses');
	}
}
