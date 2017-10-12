<?php

namespace People\Services;

use People\Models\CompanyProject;
use People\Models\CompanyProjectResource;
use People\Models\Employee;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IProjectResourceService;

class CompanyProjectResourceService implements ICompanyProjectResourceService
{
    public $ProjectService;
    public $ProjectResourceService;

    public function __construct(IProjectService $projectService,IProjectResourceService $projectResourceService)
    {

        $this->ProjectService = $projectService;
        $this->ProjectResourceService = $projectResourceService;
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

        return $companyProjectResource->company_project_id;
    }
    public function getCompanyProjectResource($companyProjectResourceId)
    {
        $resource = CompanyProjectResource::find($companyProjectResourceId);
        if (isset($resource)) {
            return $resource;
        } else {
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
        $projectResourcesArray = array();
        $currentDate           = date("Y-m-d");
        
        $projectResources = CompanyProjectResource::where('employee_id', $employeeId)
            ->with('companyProject')
            ->get();

        if (isset($projectResources)) {
            foreach ($projectResources as $projectResource) {

               list($startDate,$endDate)=$this->ProjectResourceService->getResourceStartAndEndDate($projectResource);

               if($endDate>=$currentDate)
               {
                array_push($projectResourcesArray,$projectResource);
               }
            }
        }
        return $projectResourcesArray;
    }
}
