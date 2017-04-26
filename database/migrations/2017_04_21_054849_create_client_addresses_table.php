<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAddressesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('client_addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('streetLine1')->nullable();
			$table->string('streetLine2')->nullable();
			$table->string('country')->nullable();
			$table->string('stateProvince')->nullable();
			$table->string('city')->nullable();
			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	/**s
		                 * Reverse the migrations.
		                 *
		                 * @return void
	*/
	public function down() {
		Schema::dropIfExists('client_address');
	}
}
