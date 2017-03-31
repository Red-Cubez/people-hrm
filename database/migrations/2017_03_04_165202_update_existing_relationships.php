<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateExistingRelationships extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::table('projects', function (Blueprint $table) {
			$table->integer('company_id')->unsigned();
			$table->foreign('company_id')->references('id')->on('companies');
		});

		Schema::table('clients', function (Blueprint $table) {

			$table->integer('company_id')->unsigned();
			$table->foreign('company_id')->references('id')->on('companies');
		});

		Schema::table('client_projects', function (Blueprint $table) {

			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients');
		});

		Schema::table('resources', function (Blueprint $table) {
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects');

			$table->integer('client_Project_id')->unsigned();
			$table->foreign('client_Project_id')->references('id')->on('client_projects');

			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employees');
		});

		Schema::table('addresses', function (Blueprint $table) {

			$table->integer('company_id')->unsigned();
			$table->foreign('company_id')->references('id')->on('companies');

			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('projects', function (Blueprint $table) {
			$table->dropForeign('company_id');
		});

		Schema::table('resources', function (Blueprint $table) {
			$table->dropForeign('project_id');
			$table->dropForeign('client_Project_id');
			$table->dropForeign('employee_id');
		});

		Schema::table('client_projects', function (Blueprint $table) {
			$table->dropForeign('client_id');
		});

		Schema::table('clients', function (Blueprint $table) {
			$table->dropForeign('company_id');
		});
	}
}
