<?php

namespace People\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			'People\Services\Interfaces\ICompanyService', 'People\Services\CompanyService');

		$this->app->bind(
			'People\Services\Interfaces\IClientService', 'People\Services\ClientService');

	}
}
