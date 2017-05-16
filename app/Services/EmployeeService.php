<?php

namespace People\Services;
use People\Models\CompanyProjectResource;
use People\Models\Department;
use People\Models\Employee;
use People\Models\EmployeeAddress;
use People\Models\ProjectResource;
use People\PresentationModels\EditEmployee\EditEmployeeModel;
use People\PresentationModels\Employee\EmployeeModel;
use People\PresentationModels\Employee\EmployeeProjectModel;
use People\Services\Interfaces\IEmployeeService;

class EmployeeService implements IEmployeeService {

	public function getAllEmployees() {

		$employees = Employee::orderBy('created_at', 'asc')->get();

		return $employees;
	}

	public function deleteEmployee($employee) {
		$employee->departments()->detach();
		$employee->delete();
	}

	public function createOrUpdateEmployeeAddress($request, $employeeAddress, $employeeId) {

		if (!isset($employeeAddress)) {
			$employeeAddress = new EmployeeAddress();

		}

		$employeeAddress->streetLine1 = $request->streetLine1;
		$employeeAddress->streetLine2 = $request->streetLine2;
		$employeeAddress->country = $request->country;
		$employeeAddress->stateProvince = $request->stateProvince;
		$employeeAddress->city = $request->city;
		$employeeAddress->employee_id = $employeeId;
		$employeeAddress->save();

	}

	public function createOrUpdateEmployee($request, $employee) {

		$employee->firstName = $request->firstName;
		$employee->lastName = $request->lastName;
		$employee->hireDate = $request->hireDate;
		$employee->terminationDate = $request->terminationDate;
		$employee->jobTitle = $request->jobTitle;
		$employee->annualSalary = $request->annualSalary;
		$employee->overTimeRate = $request->overTimeRate;
		$employee->hourlyRate = $request->hourlyRate;

		$employee->save();

		$this->createOrUpdateEmployeeAddress($request, $employee->address, $employee->id);

		if (count($request->departmentList) > 0) {
			$employee->departments()->detach();
			foreach ($request->departmentList as $employeeDepartmentId) {
				$employeeDepartment = Department::find($employeeDepartmentId);

				$employee->departments()->save($employeeDepartment);

			}
		}

	}

	public function createEmployee($request) {
		$employee = new Employee();
		$this->createOrUpdateEmployee($request, $employee);

	}
	public function updateEmployee($request, $employee) {

		$this->createOrUpdateEmployee($request, $employee);

	}

	public function getAllDepartments() {
		$departments = Department::orderBy('created_at', 'asc')->get();
		return $departments;
	}
	public function editEmployee($employee) {
		$editEmployeeModel = new EditEmployeeModel();

		$editEmployeeModel->employeeDepartmentIds = [];
		foreach ($employee->departments as $department) {

			array_push($editEmployeeModel->employeeDepartmentIds, $department->id);
		}

		$editEmployeeModel->employeeId = $employee->id;
		$editEmployeeModel->firstName = $employee->firstName;
		$editEmployeeModel->lastName = $employee->lastName;
		$editEmployeeModel->hireDate = $employee->hireDate;
		$editEmployeeModel->overTimeRate = $employee->OvertimeRate;
		$editEmployeeModel->terminationDate = $employee->terminationDate;
		$editEmployeeModel->jobTitle = $employee->jobTitle;
		$editEmployeeModel->annualSalary = $employee->annualSalary;
		$editEmployeeModel->hourlyRate = $employee->hourlyRate;

		$editEmployeeModel->streetLine1 = $employee->address->streetLine1;
		$editEmployeeModel->streetLine2 = $employee->address->streetLine2;
		$editEmployeeModel->country = $employee->address->country;
		$editEmployeeModel->stateProvince = $employee->address->stateProvince;
		$editEmployeeModel->city = $employee->address->city;

		return $editEmployeeModel;
	}

	public function viewEmployee($employee) {

		$employeeModel = new EmployeeModel();

		$employeeModel->employeeDepartmentIds = [];
		foreach ($employee->departments as $department) {

			array_push($employeeModel->employeeDepartmentIds, $department->name);
		}

		$totalHoursOnClientProjects = 0;
		$totalHoursOnCompanyProjects = 0;

		$employeeModel->employeeId = $employee->id;
		$employeeModel->firstName = $employee->firstName;
		$employeeModel->lastName = $employee->lastName;
		$employeeModel->hireDate = $employee->hireDate;
		$employeeModel->overTimeRate = $employee->OvertimeRate;
		$employeeModel->streetLine1 = $employee->address->streetLine1;
		$employeeModel->streetLine2 = $employee->address->streetLine2;
		$employeeModel->country = $employee->address->country;
		$employeeModel->stateProvince = $employee->address->stateProvince;
		$employeeModel->city = $employee->address->city;

		$clientProjectResources = ProjectResource::where('employee_id', $employee->id)->get();

		foreach ($clientProjectResources as $clientProjectResource) {
			$projectModel = new EmployeeProjectModel();

			$projectModel->clientName = $clientProjectResource->clientProject->client->name;
			$projectModel->projectId = $clientProjectResource->clientProject->id;
			$projectModel->projectName = $clientProjectResource->clientProject->name;
			$projectModel->clientId = $clientProjectResource->clientProject->client_id;
			$projectModel->projectStartDate = $clientProjectResource->startDate;
			$projectModel->projectEndDate = $clientProjectResource->endDate;
			$projectModel->hoursPerWeek = $clientProjectResource->hoursPerWeek;

			$currentDate = date("Y-m-d");
			$projectEndDate = $projectModel->projectEndDate;
			if ($currentDate > $projectEndDate) {
				$projectModel->isActive = False;
			} elseif ($currentDate <= $projectEndDate) {

				$projectModel->isActive = True;
				$totalHoursOnClientProjects = $totalHoursOnClientProjects + $clientProjectResource->hoursPerWeek;
			}

			if (is_null($employeeModel->clientProjects)&& (($projectModel->isActive)==True)) {
				$employeeModel->clientProjects[] = new EmployeeProjectModel;
                array_push($employeeModel->clientProjects, $projectModel);
			}

		}

		$employeeModel->totalHoursOnClientProjects = $totalHoursOnClientProjects;

		$companyProjectResources = CompanyProjectResource::where('employee_id', $employee->id)->get();
		foreach ($companyProjectResources as $companyProjectResource) {
			$projectModel = new EmployeeProjectModel();

			$projectModel->companyName = $companyProjectResource->companyProject->company->name;
			$projectModel->projectId = $companyProjectResource->companyProject->id;
			$projectModel->projectName = $companyProjectResource->companyProject->name;
			$projectModel->clientId = $companyProjectResource->companyProject->company_id;
			$projectModel->projectStartDate = $companyProjectResource->actualStartDate;
			$projectModel->projectEndDate = $companyProjectResource->actualEndDate;
			$projectModel->hoursPerWeek = $companyProjectResource->hoursPerWeek;

			$currentDate = date("Y-m-d");
			$projectEndDate = $projectModel->projectEndDate;
			if ($currentDate > $projectEndDate) {
				$projectModel->isActive = False;

			} elseif ($currentDate <= $projectEndDate) {

				$projectModel->isActive = True;
				$totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects + $companyProjectResource->hoursPerWeek;
			}

			if (is_null($employeeModel->companyProjects)&&(($projectModel->isActive)==True)) {
				$employeeModel->companyProjects[] = new EmployeeProjectModel;
                array_push($employeeModel->companyProjects, $projectModel);
			}


		}
		$employeeModel->totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects;

		if (($totalHoursOnCompanyProjects) + ($totalHoursOnClientProjects) > 40) {
			$employeeModel->isWorkingOverTime = 1;
		} else {
			$employeeModel->isWorkingOverTime = NULL;
		}
		return $employeeModel;
	}

}
