<?php

namespace People\PresentationModels\Employee;

class EmployeeModel {

	public function __construct() {
	}

	public $employeeProfile;
	public $companyName;
	public $companyId;
	public $clientProjects;
	public $companyProjects;
	public $totalHoursOnCompanyProjects;
	public $totalHoursOnClientProjects;

	public $employeeDepartmentIds;

	public function totalHoursWorked() {
		return ($this->totalHoursOnCompanyProjects) + ($this->totalHoursOnClientProjects);
	}
}
