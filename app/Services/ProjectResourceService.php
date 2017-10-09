<?php

namespace People\Services;

use People\Models\ClientProject;
use People\Models\Employee;
use People\Models\ProjectResource;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;

class ProjectResourceService implements IProjectResourceService
{
    public $ProjectService;

    public function __construct(IProjectService $projectService)
    {
        $this->ProjectService = $projectService;
    }

    public function showClientProjectResources($clientProjectId)
    {

        $currentProjectResources = ProjectResource::where('client_project_id', $clientProjectId)->orderBy('created_at', 'asc')
            ->get();

        // $projectResources=$this->ProjectService->mapResourcesDetailsToClass($currentProjectResources);
        $clientProject      = ClientProject::find($clientProjectId);
        $availableEmployees = Employee::where('company_id', $clientProject->client->company->id)->get();

        return array($currentProjectResources, $availableEmployees);
    }
    public function saveOrUpdateProjectResource($request)
    {
        if (!isset($request->projectResourceId)) {
            //store
            $projectResource = new ProjectResource();
        }

        if (isset($request->projectResourceId)) {
            //update
            $projectResource = projectResource::find($request->projectResourceId);
        }
        if (isset($request->projectResourceId)) {
            $projectResource->title             = $request->title;
            $projectResource->expectedStartDate = $request->expectedStartDate;
            $projectResource->expectedEndDate   = $request->expectedEndDate;
            $projectResource->actualStartDate   = $request->actualStartDate;
            $projectResource->actualEndDate     = $request->actualEndDate;
            $projectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $projectResource->hoursPerWeek      = $request->hoursPerWeek;

            $projectResource->save();
        } elseif (!isset($request->projectResourceId)) {
            $projectResource->title             = $request->title;
            $projectResource->expectedStartDate = $request->expectedStartDate;
            $projectResource->expectedEndDate   = $request->expectedEndDate;
            $projectResource->actualStartDate   = $request->actualStartDate;
            $projectResource->actualEndDate     = $request->actualEndDate;
            $projectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $projectResource->hoursPerWeek      = $request->hoursPerWeek;
            $projectResource->employee_id       = $request->employee_id;
            $projectResource->client_project_id = $request->clientProjectid;

            $projectResource->save();
        }
         return $projectResource->client_project_id;
    }
    public function getProjectResource($projectResourceId)
    {
        $resource = ProjectResource::find($projectResourceId);
        if (isset($resource)) {
            return $resource;
        } else {
            return null;
        }

    }
    public function updateProjectRessources($clientid)
    {
        $resource = ProjectResource::where('id', $clientid)->orderBy('created_at', 'asc')->get();
        return $resource;
    }

    public function manageProjectResources($clientProjectid)
    {

        $currentProjectResources = ProjectResource::where('client_project_id', $clientProjectid)->orderBy('created_at', 'asc')
            ->get();

        $availableEmployees = Employee::orderBy('created_at', 'asc')->get();

        return array($currentProjectResources, $availableEmployees);
    }

    public function deleteProjectResource($projectresource)
    {
        $projectresource->delete();

    }

    public function getClientProjectResourcesOnActiveProjects($employeeId)
    {
 
        $currentDate = date("Y-m-d");
        return ProjectResource::where('employee_id', $employeeId)
            ->where('actualEndDate', '>=', $currentDate)
            ->with('clientProject')
            ->get();
    }

    public function getResourceStartAndEndDate($resource)
    {
        $startDate = null;
        $endDate   = null;
        if (isset($resource->actualStartDate)) {

            $startDate = $resource->actualStartDate;
        } else {
            $startDate = $resource->expectedStartDate;

        }

        if (isset($resource->actualEndDate)) {

            $endDate = $resource->actualEndDate;
        } else {
            $endDate = $resource->expectedEndDate;

        }

        return array($startDate, $endDate);

    }
}
