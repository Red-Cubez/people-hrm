<?php

namespace People\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'People\Services\Interfaces\ICompanyService', 'People\Services\CompanyService');

        $this->app->bind(
            'People\Services\Interfaces\IClientService', 'People\Services\ClientService');

        $this->app->bind(
            'People\Services\Interfaces\IDepartmentService', 'People\Services\DepartmentService');

        $this->app->bind(
            'People\Services\Interfaces\IEmployeeService', 'People\Services\EmployeeService');

        $this->app->bind(
            'People\Services\Interfaces\IClientProjectService', 'People\Services\ClientProjectService');

        $this->app->bind(
            'People\Services\Interfaces\ICompanyProjectResourceService', 'People\Services\CompanyProjectResourceService');

        $this->app->bind(
            'People\Services\Interfaces\ICompanyProjectService', 'People\Services\CompanyProjectService');

        $this->app->bind(
            'People\Services\Interfaces\IProjectResourceService', 'People\Services\ProjectResourceService');

        $this->app->bind(
            'People\Services\Interfaces\IProjectService', 'People\Services\ProjectService');
        $this->app->bind(
            'People\Services\Interfaces\IJobTitleService', 'People\Services\JobTitleService');

        $this->app->bind(
            'People\Services\Interfaces\ICompanyHolidayService', 'People\Services\CompanyHolidayService');

        $this->app->bind(
            'People\Services\Interfaces\IProjectGrapher', 'People\Services\ProjectGrapher');
        $this->app->bind(
            'People\Services\Interfaces\IResourceFormValidator', 'People\Services\ResourceFormValidator');

        $this->app->bind(
            'People\Services\Interfaces\IEmployeeTimesheetService', 'People\Services\EmployeeTimesheetService');

        $this->app->bind(
            'People\Services\Interfaces\IEmployeeTimeoffService', 'People\Services\EmployeeTimeoffService');

        $this->app->bind(
            'People\Services\Interfaces\IUserAuthenticationService', 'People\Services\UserAuthenticationService');

        $this->app->bind(
            'People\Services\Interfaces\IRoleService', 'People\Services\RoleService');

        $this->app->bind(
            'People\Services\Interfaces\IUserRolesService', 'People\Services\UserRolesService');

        $this->app->bind(
            'People\Services\Interfaces\ICompanySettingService', 'People\Services\CompanySettingService');

        $this->app->bind(
            'People\Services\Interfaces\IReportService', 'People\Services\ReportService');

        $this->app->bind(
            'People\Services\Interfaces\IDateTimeService', 'People\Services\DateTimeService');

        $this->app->bind(
            'People\Services\Interfaces\IPermissionService', 'People\Services\PermissionService');

        $this->app->bind(
            'People\Services\Interfaces\IValidationService', 'People\Services\ValidationService');
    }

}
