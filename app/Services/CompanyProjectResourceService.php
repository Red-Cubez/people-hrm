<?php

namespace People\Services;

use People\Models\CompanyProjectResource;
use People\Models\Employee;
use People\Services\Interfaces\ICompanyProjectResourceService;

class CompanyProjectResourceService implements ICompanyProjectResourceService
{

    public function showCompanyProjectResources($companyProjectId)
    {

        $currentProjectResources = CompanyProjectResource::where('company_project_id', $companyProjectId)->orderBy('created_at', 'asc')
            ->get();

        $availableEmployees = Employee::orderBy('created_at', 'asc')->get();

        return array($currentProjectResources, $availableEmployees);
    }

    public function saveOrUpdateCompanyProjectResource($request)
    {
        if (!isset($request->projectResourceId)) {
            $companyProjectResource = new CompanyProjectResource();
        }

        if (isset($request->projectResourceId)) {
            $companyProjectResource = CompanyProjectResource::find($request->projectResourceId);
        }

        if (isset($request->projectResourceId)) {
            //update
            $companyProjectResource->title = $request->title;
            $companyProjectResource->expectedStartDate = $request->expectedStartDate;
            $companyProjectResource->expectedEndDate = $request->expectedEndDate;
            $companyProjectResource->actualStartDate = $request->actualStartDate;
            $companyProjectResource->actualEndDate = $request->actualEndDate;
            $companyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $companyProjectResource->hoursPerWeek = $request->hoursPerWeek;

            $companyProjectResource->save();

        } elseif (!isset($request->projectResourceId)) {
            //save
            $companyProjectResource->title = $request->title;
            $companyProjectResource->expectedStartDate = $request->expectedStartDate;
            $companyProjectResource->expectedEndDate = $request->expectedEndDate;
            $companyProjectResource->actualStartDate = $request->actualStartDate;
            $companyProjectResource->actualEndDate = $request->actualEndDate;
            $companyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $companyProjectResource->hoursPerWeek = $request->hoursPerWeek;
            $companyProjectResource->employee_id = $request->employee_id;
            $companyProjectResource->company_project_id = $request->companyProjectId;

            $companyProjectResource->save();
        }
    }

    public function showEditForm($companyProjectId)
    {

        $resource = CompanyProjectResource::where('id', $companyProjectId)->orderBy('created_at', 'asc')->get();
        return $resource;
    }

    public function deleteCompanyProjectResource($companyprojectresource)
    {
        $companyprojectresource->delete();
    }

    public function getCompanyProjectResourcesOnActiveProjects($employeeId)
    {
        $currentDate = date("Y-m-d");
        return CompanyProjectResource::where('employee_id', $employeeId)
            ->where('actualEndDate', '>=', $currentDate)
            ->with('companyProject')
            ->get();
    }
}
