<?php

namespace People\Services;

use People\Models\Client;
use People\Models\Company;
use People\Models\Department;
use People\Models\Employee;
use People\Models\EmployeeAddress;
use People\PresentationModels\EditEmployee\EditEmployeeModel;
use People\PresentationModels\EmployeeProfileModel;
use People\PresentationModels\Employee\EmployeeModel;
use People\PresentationModels\Employee\EmployeeProjectModel;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IProjectResourceService;

class EmployeeService implements IEmployeeService
{
    public $CompanyProjectResourceService;
    public $ClientProjectResourceService;

    public function __construct(ICompanyProjectResourceService $companyProjectResourceService, IProjectResourceService $clientProjectResourceService)
    {

        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ClientProjectResourceService  = $clientProjectResourceService;
    }

    public function getAllEmployeesWithBirthDayThisMonth($company)
    {
        $currentDate = date("m");

        return Employee::orderBy('birthDate', 'asc')->where('company_id', $company->id)->whereMonth('birthDate', '=', $currentDate)->get();

    }

    public function getAllEmployees()
    {

        $employees = Employee::orderBy('created_at', 'asc')->get();

        return $employees;
    }

    public function deleteEmployee($employee)
    {
        $employee->departments()->detach();
        $employee->delete();
    }

    public function createEmployee($request)
    {
        $employee = new Employee();
        $this->createOrUpdateEmployee($request, $employee);
        return $employee->id;

    }
    public function getNonRegisteredEmployees($companyId)
    {
        $nonRegisteredEmployees = Employee::where('company_id', $companyId)->where('user_id', null)->get();
        if (isset($nonRegisteredEmployees)) {
            return $nonRegisteredEmployees;
        } else {
            return null;
        }
    }
    public function attachUserIdToEmployee($userId, $employeeId)
    {
        $employee = Employee::find($employeeId);

        $employee->user_id = $userId;

        $employee->save();
    }

    public function createOrUpdateEmployee($request, $employee)
    {
        if (isset($request->companyId)) {
            $employee->company_id = $request->companyId;
        }
        $employee->firstName       = $request->firstName;
        $employee->lastName        = $request->lastName;
        $employee->birthDate       = $request->birthDate;
        $employee->hireDate        = $request->hireDate;
        $employee->terminationDate = $request->terminationDate;
        $employee->job_title_id    = $request->jobTitleId;
        $employee->annualSalary    = $request->annualSalary;
        $employee->overTimeRate    = $request->overTimeRate;
        $employee->hourlyRate      = $request->hourlyRate;

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

    public function createOrUpdateEmployeeAddress($request, $employeeAddress, $employeeId)
    {

        if (!isset($employeeAddress)) {
            $employeeAddress = new EmployeeAddress();
        }
        $employeeAddress->streetLine1   = $request->streetLine1;
        $employeeAddress->streetLine2   = $request->streetLine2;
        $employeeAddress->country       = $request->country;
        $employeeAddress->stateProvince = $request->stateProvince;
        $employeeAddress->city          = $request->city;
        $employeeAddress->employee_id   = $employeeId;
        $employeeAddress->save();
    }

    public function updateEmployee($request, $employee)
    {
        $this->createOrUpdateEmployee($request, $employee);
    }

    public function getAllDepartments()
    {
        $departments = Department::orderBy('created_at', 'asc')->get();
        return $departments;
    }

    public function editEmployee($employee)
    {
        $editEmployeeModel = new EditEmployeeModel();

        $editEmployeeModel->employeeDepartmentIds = [];
        foreach ($employee->departments as $department) {

            array_push($editEmployeeModel->employeeDepartmentIds, $department->id);
        }

        $editEmployeeModel->employeeProfile = $this->mapEmployeeProfile($employee);

        return $editEmployeeModel;
    }

    private function mapEmployeeProfile($employee)
    {

        $employeeProfileModel = new EmployeeProfileModel();

        $employeeProfileModel->employeeId      = $employee->id;
        $employeeProfileModel->firstName       = $employee->firstName;
        $employeeProfileModel->lastName        = $employee->lastName;
        $employeeProfileModel->birthDate       = $employee->birthDate;
        $employeeProfileModel->hireDate        = $employee->hireDate;
        $employeeProfileModel->overTimeRate    = $employee->OvertimeRate;
        $employeeProfileModel->terminationDate = $employee->terminationDate;
        $employeeProfileModel->jobTitle        = $employee->JobTitle->title;
        $employeeProfileModel->annualSalary    = $employee->annualSalary;
        $employeeProfileModel->hourlyRate      = $employee->hourlyRate;
        if (isset($employee->address)) {
            $employeeProfileModel->streetLine1   = $employee->address->streetLine1;
            $employeeProfileModel->streetLine2   = $employee->address->streetLine2;
            $employeeProfileModel->country       = $employee->address->country;
            $employeeProfileModel->stateProvince = $employee->address->stateProvince;
            $employeeProfileModel->city          = $employee->address->city;
        }

        return $employeeProfileModel;

    }
    public function getAllEmployeesOfCompany($companyId)
    {
        return Employee::orderBy('firstName', 'asc')->where('company_id', $companyId)->get();
    }

    public function getAllClientsOfCompany($companyId)
    {
        return Client::where('company_id', $companyId)->get();

    }
    public function getEmployee($employeeId)
    {

        return Employee::find($employeeId);

    }

    public function viewEmployee($employee)
    {

        $employeeModel = new EmployeeModel();

        $employeeModel->employeeDepartmentIds = [];
        foreach ($employee->departments as $department) {

            array_push($employeeModel->employeeDepartmentIds, $department->name);
        }

        $totalHoursOnClientProjects  = 0;
        $totalHoursOnCompanyProjects = 0;

        $employeeModel->employeeProfile = $this->mapEmployeeProfile($employee);

        $clientProjectResources = $this->ClientProjectResourceService->getClientProjectResourcesOnActiveProjects($employee->id);

        foreach ($clientProjectResources as $clientProjectResource) {
            
            list($startDate,$endDate)=$this->ClientProjectResourceService->getResourceStartAndEndDate($clientProjectResource);

            $projectModel = new EmployeeProjectModel();
            
            $projectModel->clientName       = $clientProjectResource->clientProject->client->name;
            $projectModel->projectId        = $clientProjectResource->clientProject->id;
            $projectModel->projectName      = $clientProjectResource->clientProject->name;
            $projectModel->clientId         = $clientProjectResource->clientProject->client_id;
            $projectModel->projectStartDate = $startDate;
            $projectModel->projectEndDate   = $endDate;
            $projectModel->hoursPerWeek     = $clientProjectResource->hoursPerWeek;

            $projectModel->isActive     = true;
            $totalHoursOnClientProjects = $totalHoursOnClientProjects + $clientProjectResource->hoursPerWeek;

            if (is_null($employeeModel->clientProjects)) {
                $employeeModel->clientProjects = array();
                array_push($employeeModel->clientProjects, $projectModel);
            }
            // if (is_null($employeeModel->clientProjects)) {
            //      $employeeModel->clientProjects[] = new EmployeeProjectModel;
            //      array_push($employeeModel->clientProjects, $projectModel);
            //  }
        }

        $employeeModel->totalHoursOnClientProjects = $totalHoursOnClientProjects;
        $companyProjectResources                   = $this->CompanyProjectResourceService->getCompanyProjectResourcesOnActiveProjects($employee->id);

        foreach ($companyProjectResources as $companyProjectResource) {

            list($startDate,$endDate)=$this->ClientProjectResourceService->getResourceStartAndEndDate($companyProjectResource);

            $projectModel = new EmployeeProjectModel();

            $projectModel->companyName      = $companyProjectResource->companyProject->company->name;
            $projectModel->projectId        = $companyProjectResource->companyProject->id;
            $projectModel->projectName      = $companyProjectResource->companyProject->name;
            $projectModel->clientId         = $companyProjectResource->companyProject->company_id;
            $projectModel->projectStartDate = $startDate;
            $projectModel->projectEndDate   = $endDate;
            $projectModel->hoursPerWeek     = $companyProjectResource->hoursPerWeek;

            $projectModel->isActive      = true;
            $totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects + $companyProjectResource->hoursPerWeek;

            if (is_null($employeeModel->companyProjects)) {
                $employeeModel->companyProjects = array();
                array_push($employeeModel->companyProjects, $projectModel);
            }
            // if (is_null($employeeModel->companyProjects)) {
            //     $employeeModel->companyProjects[] = new EmployeeProjectModel;
            //     array_push($employeeModel->companyProjects, $projectModel);
            // }
        }
        $employeeModel->totalHoursOnCompanyProjects = $totalHoursOnCompanyProjects;

        if (($totalHoursOnCompanyProjects) + ($totalHoursOnClientProjects) > 40) {
            $employeeModel->isWorkingOverTime = 1;
        } else {
            $employeeModel->isWorkingOverTime = null;
        }
  

        return $employeeModel;
    }

}
