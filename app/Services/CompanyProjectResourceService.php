<?php

namespace People\Services;

use People\Models\CompanyProject;
use People\Models\CompanyProjectResource;
use People\Models\Employee;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\IProjectService;

class CompanyProjectResourceService implements ICompanyProjectResourceService
{
    public $ProjectService;

    public function __construct(IProjectService $projectService)
    {

        $this->ProjectService = $projectService;
    }

    public function showCompanyProjectResources($companyProjectId)
    {
        $companyProject          = CompanyProject::find($companyProjectId);
        $currentProjectResources = CompanyProjectResource::where('company_project_id', $companyProjectId)->orderBy('created_at', 'asc')
            ->get();

        $projectResources = $this->ProjectService->mapResourcesDetailsToClass($currentProjectResources, true);

        $availableEmployees = Employee::where('company_id', $companyProject->company->id)->get();

        return array($projectResources, $availableEmployees);
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
            $companyProjectResource->title             = $request->title;
            $companyProjectResource->expectedStartDate = $request->expectedStartDate;
            $companyProjectResource->expectedEndDate   = $request->expectedEndDate;
            $companyProjectResource->actualStartDate   = $request->actualStartDate;
            $companyProjectResource->actualEndDate     = $request->actualEndDate;
            $companyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $companyProjectResource->hoursPerWeek      = $request->hoursPerWeek;

            $companyProjectResource->save();

        } elseif (!isset($request->projectResourceId)) {
            //save
            $companyProjectResource->title              = $request->title;
            $companyProjectResource->expectedStartDate  = $request->expectedStartDate;
            $companyProjectResource->expectedEndDate    = $request->expectedEndDate;
            $companyProjectResource->actualStartDate    = $request->actualStartDate;
            $companyProjectResource->actualEndDate      = $request->actualEndDate;
            $companyProjectResource->hourlyBillingRate  = $request->hourlyBillingRate;
            $companyProjectResource->hoursPerWeek       = $request->hoursPerWeek;
            $companyProjectResource->employee_id        = $request->employee_id;
            $companyProjectResource->company_project_id = $request->companyProjectId;

            $companyProjectResource->save();
        }
    }
    public function getCompanyProjectResource($companyProjectResourceId)
    {
       $resource=CompanyProjectResource::find($companyProjectResourceId);
       if(isset($resource))
       {
        return $resource;
       }
       else
       {
        return null;
       }
    }

    public function showEditForm($companyProjectResourceId)
    {

        $resource = CompanyProjectResource::find($companyProjectResourceId);

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
