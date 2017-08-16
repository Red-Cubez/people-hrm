<?php

namespace Usman\Timesheet;

use Illuminate\Support\ServiceProvider;

class TimesheetServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {

		require __DIR__ . '/Http/routes.php';
		// $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
		$this->loadMigrationsFrom(__DIR__ . '/database/migrations');
		$this->loadViewsFrom(__DIR__ . '/resources/views', 'timesheet');
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			'todo', function ($app) {
				return new Timesheet;
			});
		$this->app->bind(
			'Usman\Timesheet\Services\Interfaces\IEmployeeTimesheetService', 'Usman\Timesheet\Services\EmployeeTimesheetService');
		// $this->app->bind(
		// 	'People\Services\Interfaces\ICompanyService', 'People\Services\CompanyService');

	}

}
