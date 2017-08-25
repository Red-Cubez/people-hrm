<?php

namespace People\Services;

use People\Models\Company;
use People\Models\CompanyAddress;
use People\PresentationModels\Company\CompanyClientModel;
use People\PresentationModels\Company\CompanyClientProjectModel;
use People\PresentationModels\Company\CompanyEmployeeModel;
use People\PresentationModels\Company\CompanyHolidayModel;
use People\PresentationModels\Company\CompanyJobTitles;
use People\PresentationModels\Company\CompanyProfileModel;
use People\PresentationModels\Company\CompanyProjectModel;
use People\PresentationModels\Company\EmployeesBirthDayModel;
use People\Services\Interfaces\ICompanyService;

class CompanyService implements ICompanyService
{
    public function getCompanyAddressAndCompanyProjects($company)
    {
        $companyAddress = $company->address;
        return array($company, $companyAddress);
    }

    public function createCompany($request)
    {

        $company                     = new Company();
        $company->name               = $request->name;
        $company->normalHoursPerWeek = $request->normalHoursPerWeek;
        $company->applyOverTimeRule  = $request->applyOverTimeRule;
        if ($request->applyOverTimeRule == null) {
            $company->applyOverTimeRule = 0;

        }
        $company->save();

        $this->createOrUpdateCompanyAddress($request, null, $company->id);

    }

    public function createOrUpdateCompanyAddress($userRequest, $companyAddress, $companyId)
    {

        if (!isset($companyAddress)) {
            $companyAddress = new CompanyAddress();
        }
        $companyAddress->streetLine1   = $userRequest->streetLine1;
        $companyAddress->streetLine2   = $userRequest->streetLine2;
        $companyAddress->country       = $userRequest->country;
        $companyAddress->stateProvince = $userRequest->stateProvince;
        $companyAddress->city          = $userRequest->city;
        $companyAddress->company_id    = $companyId;
        $companyAddress->save();
    }

    public function updateCompany($updateRequest, $company)
    {
        $company->name               = $updateRequest->name;
        $company->normalHoursPerWeek = $updateRequest->normalHoursPerWeek;
        $company->applyOverTimeRule  = $updateRequest->applyOverTimeRule;

        if ($updateRequest->applyOverTimeRule == null) {
            $company->applyOverTimeRule = 0;

        }

        $this->createOrUpdateCompanyAddress($updateRequest, $company->address, $company->id);

        $company->save();
    }

    public function deleteCompany($company)
    {
        $company->delete();
    }

    public function getAllCompanies()
    {
        $companies = Company::orderBy('created_at', 'asc')->get();
        return $companies;
    }
    public function getCompanyClientProjects($company)
    {
        $companyClientProjects = [];
        foreach ($company->clients as $client) {

            $companyClientProjects[] = $client->projects;
        }
    }

    public function mapCompanyProfile($company, $companyAddress, $companyJobTitles, $employeesWithBirthday, $companyHolidays,
        $companyCurrentEmployees, $companyCurrentClients) {

//        dd($company);

        $companyProfileModel = new CompanyProfileModel();

        $companyProfileModel->companyName        = $company->name;
        $companyProfileModel->companyId          = $company->id;
        $companyProfileModel->normalHoursPerWeek = $company->normalHoursPerWeek;
        $companyProfileModel->applyOverTimeRule  = $company->applyOverTimeRule;
        if (isset($companyAddress)) {
            $companyProfileModel->streetLine1   = $companyAddress->streetLine1;
            $companyProfileModel->streetLine2   = $companyAddress->streetLine2;
            $companyProfileModel->country       = $companyAddress->country;
            $companyProfileModel->stateProvince = $companyAddress->stateProvince;
            $companyProfileModel->city          = $companyAddress->city;
        }
//        dd($company);
        foreach ($companyJobTitles as $jobTitle) {
            $CompanyJobTitleModel             = new CompanyJobTitles();
            $CompanyJobTitleModel->jobTitle   = $jobTitle->title;
            $CompanyJobTitleModel->jobTitleId = $jobTitle->id;

            if (is_null($companyProfileModel->jobTitles)) {
                $companyProfileModel->jobTitles = [];
            }
            array_push($companyProfileModel->jobTitles, $CompanyJobTitleModel);
        }
//        dd($company);
        foreach ($employeesWithBirthday as $employee) {
            $employeesBirthdayModel            = new EmployeesBirthDayModel();
            $employeesBirthdayModel->firstName = $employee->firstName;
            $employeesBirthdayModel->lastName  = $employee->lastName;
            $employeesBirthdayModel->birthDate = $employee->birthDate;

            if (is_null($companyProfileModel->employeesBirthday)) {
                $companyProfileModel->employeesBirthday = [];
            }
            array_push($companyProfileModel->employeesBirthday, $employeesBirthdayModel);
        }
//        dd($company);
        foreach ($company->projects as $project) {
            $companyProjectModel                    = new CompanyProjectModel();
            $companyProjectModel->projectId         = $project->id;
            $companyProjectModel->projectName       = $project->name;
            $companyProjectModel->expectedStartDate = $project->expectedStartDate;
            $companyProjectModel->expectedEndDate   = $project->expectedEndDate;
            $companyProjectModel->actualStartDate   = $project->actualStartDate;
            $companyProjectModel->actualEndDate     = $project->actualEndDate;
            $companyProjectModel->budget            = $project->budget;
            $companyProjectModel->cost              = $project->cost;

            if (is_null($companyProfileModel->companyProjects)) {
                $companyProfileModel->companyProjects = [];
            }
            array_push($companyProfileModel->companyProjects, $companyProjectModel);
        }
        // $companyClientProjects = $this->getCompanyClientProjects($company);
        //dd($companyClientProjects);

        foreach ($company->clients as $client) {
            foreach ($client->projects as $project) {

                $companyClientProjectModel = new CompanyClientProjectModel();

                $companyClientProjectModel->projectId         = $project->id;
                $companyClientProjectModel->clientId          = $project->client_id;
                $companyClientProjectModel->projectName       = $project->name;
                $companyClientProjectModel->expectedStartDate = $project->expectedStartDate;
                $companyClientProjectModel->expectedEndDate   = $project->expectedEndDate;
                $companyClientProjectModel->actualStartDate   = $project->actualStartDate;
                $companyClientProjectModel->actualEndDate     = $project->actualEndDate;
                $companyClientProjectModel->budget            = $project->budget;
                $companyClientProjectModel->cost              = $project->cost;

                if (is_null($companyProfileModel->clientProjects)) {
                    $companyProfileModel->clientProjects = [];
                }
                array_push($companyProfileModel->clientProjects, $companyClientProjectModel);
            }
        }
//        dd($company);
        foreach ($companyHolidays as $holiday) {
            $companyHolidayModel                = new CompanyHolidayModel();
            $companyHolidayModel->holidayId     = $holiday->id;
            $companyHolidayModel->holidayName   = $holiday->name;
            $companyHolidayModel->startDate     = $holiday->startDate;
            $companyHolidayModel->endDate       = $holiday->endDate;
            $companyHolidayModel->countHolidays = $holiday->holidays;

            if (is_null($companyProfileModel->companyHolidays)) {
                $companyProfileModel->companyHolidays = [];
            }
            array_push($companyProfileModel->companyHolidays, $companyHolidayModel);
        }
//        dd($company);
        foreach ($companyCurrentEmployees as $currentEmployee) {

            $companyEmployeeModel             = new CompanyEmployeeModel();
            $companyEmployeeModel->employeeId = $currentEmployee->id;
            $companyEmployeeModel->firstName  = $currentEmployee->firstName;
            $companyEmployeeModel->lastName   = $currentEmployee->lastName;
            $companyEmployeeModel->hireDate   = $currentEmployee->hireDate;

            if (is_null($companyProfileModel->companyEmployees)) {
                $companyProfileModel->companyEmployees = [];
            }
            array_push($companyProfileModel->companyEmployees, $companyEmployeeModel);
        }
//        dd($company);
        foreach ($companyCurrentClients as $currentClient) {
            $companyClienteModel                = new CompanyClientModel();
            $companyClienteModel->clientId      = $currentClient->id;
            $companyClienteModel->clientName    = $currentClient->name;
            $companyClienteModel->contactPerson = $currentClient->contactPerson;
            $companyClienteModel->contactNumber = $currentClient->contactNumber;

            if (is_null($companyProfileModel->companyClients)) {
                $companyProfileModel->companyClients = [];
            }
            array_push($companyProfileModel->companyClients, $companyClienteModel);
        }
//        dd($company);
        return $companyProfileModel;
    }
}
