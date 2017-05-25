<?php

namespace People\Services;

use People\Models\Company;
use People\Models\CompanyAddress;
use People\PresentationModels\Company\CompanyHolidayModel;
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

        $company = new Company();
        $company->name = $request->name;
        $company->normalHoursPerWeek = $request->normalHoursPerWeek;
        $company->applyOverTimeRule = $request->applyOverTimeRule;
        if ($request->applyOverTimeRule == NULL) {
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
        $companyAddress->streetLine1 = $userRequest->streetLine1;
        $companyAddress->streetLine2 = $userRequest->streetLine2;
        $companyAddress->country = $userRequest->country;
        $companyAddress->stateProvince = $userRequest->stateProvince;
        $companyAddress->city = $userRequest->city;
        $companyAddress->company_id = $companyId;
        $companyAddress->save();
    }

    public function updateCompany($updateRequest, $company)
    {
        $company->name = $updateRequest->name;
        $company->normalHoursPerWeek = $updateRequest->normalHoursPerWeek;
        $company->applyOverTimeRule = $updateRequest->applyOverTimeRule;

        if ($updateRequest->applyOverTimeRule == NULL) {
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

    public function mapCompanyProfile($company, $companyAddress, $companyJobTitles, $employeesWithBirthday, $companyHolidays)
    {
        $companyProfileModel = new CompanyProfileModel();

        $companyProfileModel->companyName = $company->name;
        $companyProfileModel->companyId = $company->id;
        $companyProfileModel->normalHoursPerWeek = $company->normalHoursPerWeek;
        $companyProfileModel->applyOverTimeRule = $company->applyOverTimeRule;
        $companyProfileModel->streetLine1 = $companyAddress->streetLine1;
        $companyProfileModel->streetLine2 = $companyAddress->streetLine2;
        $companyProfileModel->country = $companyAddress->country;
        $companyProfileModel->stateProvince = $companyAddress->stateProvince;
        $companyProfileModel->city = $companyAddress->city;

        $companyProfileModel->jobTitles = [];
        foreach ($companyJobTitles as $jobTitle) {
            array_push($companyProfileModel->jobTitles, $jobTitle->title);
        }

        foreach ($employeesWithBirthday as $employee) {
            $employeesBirthdayModel = new EmployeesBirthDayModel();
            $employeesBirthdayModel->firstName = $employee->firstName;
            $employeesBirthdayModel->lastName = $employee->lastName;
            $employeesBirthdayModel->birthDate = $employee->birthDate;

            if (is_null($companyProfileModel->employeesBirthday)) {
                $companyProfileModel->employeesBirthday = [];
            }
            array_push($companyProfileModel->employeesBirthday, $employeesBirthdayModel);
        }

        foreach ($company->projects as $project) {
            $companyProjectModel = new CompanyProjectModel();
            $companyProjectModel->projectId = $project->id;
            $companyProjectModel->projectName = $project->name;
            $companyProjectModel->expectedStartDate = $project->expectedStartDate;
            $companyProjectModel->expectedEndDate = $project->expectedEndDate;
            $companyProjectModel->actualStartDate = $project->actualStartDate;
            $companyProjectModel->actualEndDate = $project->actualEndDate;
            $companyProjectModel->budget = $project->budget;
            $companyProjectModel->cost = $project->cost;

            if (is_null($companyProfileModel->companyProjects)) {
                $companyProfileModel->companyProjects = [];
            }
            array_push($companyProfileModel->companyProjects, $companyProjectModel);
        }

        foreach ($companyHolidays as $holiday) {
            $companyHolidayModel = new CompanyHolidayModel();
            $companyHolidayModel->holidayId = $holiday->id;
            $companyHolidayModel->holidayName = $holiday->name;
            $companyHolidayModel->startDate = $holiday->startDate;
            $companyHolidayModel->endDate = $holiday->endDate;
            $companyHolidayModel->countHolidays = $holiday->holidays;

            if (is_null($companyProfileModel->companyHolidays)) {
                $companyProfileModel->companyHolidays = [];
            }
            array_push($companyProfileModel->companyHolidays, $companyHolidayModel);
        }

        return $companyProfileModel;
    }
}