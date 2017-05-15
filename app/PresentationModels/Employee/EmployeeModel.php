<?php

namespace People\PresentationModels\Employee;

class EmployeeModel {

	public function __construct() {
	}

	public $employeeId;
	public $firstName;
	public $lastName;
	public $hireDate;
	public $overTimeRate;
	public $streetLine1;
	public $streetLine2;
	public $stateProvince;
	public $country;
	public $city;

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
