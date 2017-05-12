<?php

namespace People\Services;
use People\Models\ClientProject;
use People\Models\CompanyProjectResource;
use People\Models\Department;
use People\Models\Employee;
use People\Models\EmployeeAddress;
use People\Models\ProjectResource;
use People\PresentationModels\Employee\EmployeeModel;
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

	private function getHoursEngagedOnProjects($employeeId) {
		$hoursEngaged;
		$clientProjectResources = ProjectResource::where('employee_id', $employeeId)->get();
		$clientProjectResources = CompanyProjectResource::where('employee_id', $employeeId)->get();
		// foreach ($variable as $key => $value) {
		// 	# code...
		// }

	}

	public function showEmployee($employee) {

		$employeeModel = new EmployeeModel();

		$employeeModel->employeeDepartmentIds = [];
		foreach ($employee->departments as $department) {

			array_push($employeeModel->employeeDepartmentIds, $department->id);
		}

		$totalHoursOnClientProjects = 0;
		$clientProjectResources = ProjectResource::where('employee_id', $employee->id)->get();
		$clientProjectResources = CompanyProjectResource::where('employee_id', $employee->id)->get();

		foreach ($clientProjectResources as $clientProjectResource) {
			$projectModel = new EmployeeProjectModel();

			$projectModel->clientName = $clientProjectResource->clientProject->client->name;
			$projectModel->projectId = $clientProjectResource->clientProject->id;

			$totalHoursOnClientProjects = $totalHoursOnClientProjects + $clientProjectResource->hoursPerWeek;

			array_push($employeeModel->clientProjects, $projectModel);
		}
		$employeeModel->totalHoursOnClientProjects = $totalHoursOnClientProjects;
//TODO same thing for Company projects
		// // foreach ($clientProjectResources as $clientProjectResource) {
		// // 			$projectModel = new EmployeeProjectModel();

// // 			$projectModel->clientName = $clientProjectResource->clientProject->client->name;
		// // 			$projectModel->projectId = $clientProjectResource->clientProject->id;

// // 			array_push($employeeModel->clientProjects, $projectModel);

// 		}

// 		$employeeClientProjectIds = [];
		// 		$employeeClientProjects = [];
		// 		$employeeCompanyProjectIds = [];
		// 		$employeeCompanyProjects = [];
		// 		$clientNames = [];
		// 		$companyNames = [];
		// //
		// 		$employeeModels = [];

		//dd($clientProjectResources[0]->clientProject;

		foreach ($clientProjectResources as $clientProjectResource) {
			$employeeModel = new EmployeeModel();
			$employeeModel->clientName = $clientProjectResource->clientProject->client->name;
			$employeeModel->clientId = $clientProjectResource->clientProject->client->id;

			array_push($employeeModels, $employeeModel);

			// 	// dd($clientProjectResource->clientProject->client);

			$totalHoursOnClientProjects = $totalHoursOnClientProjects + $clientProjectResource->hoursPerWeek;

			// 	// $employeeClientProjectIds[] = $clientProjectResource->client_project_id;

		}
		//dd($totalHoursOnClientProjects);
		//dd($employeeModels);
		//dd($employeeModels);

		$totalHoursOnCompanyProjects = 0;
		$companyProjectResources = CompanyProjectResource::where('employee_id', $employee->id)->get();

		foreach ($companyProjectResources as $companyProjectResource) {

			$companyProjectResource->companyProject = $companyProjectResource->companyproject->company->name;
			$companyProjectResource->companyId = $companyProjectResource->companyproject->company->name;
			array_push($employeeModels, $employeeModel);
			$totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects + $companyProjectResource->hoursPerWeek;

		}
		$employeeModel->totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects;
		// $totalHoursWorked = $totalHoursOnClientProjects + $totalHoursOnCompanyProjects;

		// array_push($employeeModels, $sumOfTotalHoursWorked);
		// dd($employeeModels);

		// if ($sumOfTotalHoursWorked > 40) {
		// 	$isWorkingOverTime = 1;
		// } else {
		// 	$isWorkingOverTime = NULL;
		// }

		// foreach ($employeeClientProjectIds as $employeeClientProjectId) {
		// 	$employeeClientProjects[] = ClientProject::where('id', $employeeClientProjectId)->get();

		// }

		// foreach ($employeeCompanyProjectIds as $employeeCompanyProjectId) {
		// 	$employeeCompanyProjects[] = CompanyProject::where('id', $employeeCompanyProjectId)->get();
		// }

		// foreach ($employeeClientProjects as $employeeClientProject) {

		// 	$clientNames[] = Client::where('id', $employeeClientProject[0]->client_id)->get();
		// }

		// foreach ($employeeClientProjects as $employeeClientProject) {

		// 	$companyNames[] = Company::where('id', $employeeClientProject[0]->company_id)->get();
		// }

		return $employeeModel;
		// return array($employee, $departments, $employeeDepartmentIds, $sumOfTotalHoursWorked, $isWorkingOverTime,
		// 	$employeeClientProjects, $employeeCompanyProjects, $clientNames, $companyNames);

	}

}
