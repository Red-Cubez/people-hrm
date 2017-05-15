<?php

namespace People\PresentationModels\Employee;

class EmployeeModel {

	public function __construct() {
		$this->companyProjects[] = new EmployeeProjectModel;
		$this->clientProjects[] = new EmployeeProjectModel;
	}

	public $employeeId;
	public $firstName;
	public $lastName;
	public $hireDate;
	public $overTimeRate;
	public $streetLine1;
	public $isWorkingOverTime;

	public $companyName;
	public $companyId;
	public $employeeDepartmentIds;
	public $clientProjects;
	public $companyProjects;
	public $totalHoursOnCompanyProjects;
	public $totalHoursOnClientProjects;

	public function totalHoursWorked() {
		return ($this->totalHoursOnCompanyProjects) + ($this->totalHoursOnClientProjects);
	}
}
