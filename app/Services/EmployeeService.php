<?php

namespace People\Services;
use People\Models\ClientProject;
use People\Models\CompanyProjectResource;
use People\Models\Department;
use People\Models\Employee;
use People\Models\EmployeeAddress;
use People\Models\ProjectResource;
use People\Services\Interfaces\IEmployeeService;

class EmployeeService implements IEmployeeService {

	public function getAllEmployees() {

		$employees = Employee::orderBy('created_at', 'asc')->get();
		$departments = Department::orderBy('created_at', 'asc')->get();
		return array($employees, $departments);
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

		// if (!isset($employee)) {
		// 	$employee = new Employee();
		// }
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
	public function showEmployee($employee) {

		$employeeDepartmentIds = [];
		foreach ($employee->departments as $department) {

			array_push($employeeDepartmentIds, $department->id);
		}

		$departments = Department::orderBy('created_at', 'asc')->get();

		$totalHoursOnClientProjects = 0;
		$clientProjectResources = ProjectResource::where('employee_id', $employee->id)->get();

		$employeeClientProjectIds = [];
		$employeeClientProjects = [];
		foreach ($clientProjectResources as $clientProjectResource) {

			$totalHoursOnClientProjects = $totalHoursOnClientProjects + $clientProjectResource->hoursPerWeek;

			$employeeClientProjectIds[] = $clientProjectResource->client_project_id;

		}

		$totalHoursOnCompanyProjects = 0;
		$companyProjectResources = CompanyProjectResource::where('employee_id', $employee->id)->get();

		foreach ($companyProjectResources as $companyProjectResource) {

			$totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects + $companyProjectResource->hoursPerWeek;
		}

		$sumOfTotalHoursWorked = $totalHoursOnClientProjects + $totalHoursOnCompanyProjects;
		if ($sumOfTotalHoursWorked > 40) {
			$isWorkingOverTime = 1;
		} else {
			$isWorkingOverTime = NULL;
		}

		foreach ($employeeClientProjectIds as $employeeClientProjectId) {
			$employeeClientProjects[] = ClientProject::where('id', $employeeClientProjectId)->get();
		}
		//dd($employeeClientProjects);
		return array($employee, $departments, $employeeDepartmentIds, $sumOfTotalHoursWorked, $isWorkingOverTime, $employeeClientProjects);

	}

}
