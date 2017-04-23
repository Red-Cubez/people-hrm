<?php

use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyCompanyId extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	/*	public function up() {
		            		Schema::table('projects', function (Blueprint $table) {
		            			$table->dropForeign('company_id');
		            			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
		            		});
		            	}
	*/
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}
}
