<?php

namespace People\Services;
use People\Models\ProjectResource;
use People\Models\Employee;
use People\Services\Interfaces\IProjectResourceService;

class ProjectResourceService implements IProjectResourceService {
   
        public function saveOrUpdateProjectResource($request) {

    	if (!isset($request->projectResourceId))
    	 {
            $projectResource = new ProjectResource();
          }

		if (isset($request->projectResourceId)) 
		{
            $projectResource = projectResource::find($request->projectResourceId);
         }
		//  //TODO get the relative project Resource id
        if ( isset($request->projectResourceId))
         {
        	$projectResource->title = $request->title;
			$projectResource->expectedStartDate = $request->expectedStartDate;
			$projectResource->expectedEndDate = $request->expectedEndDate;
			$projectResource->actualStartDate = $request->actualStartDate;
			$projectResource->actualEndDate = $request->actualEndDate;
			$projectResource->hourlyBillingRate = $request->hourlyBillingRate;
			$projectResource->hoursPerWeek = $request->hoursPerWeek;

			$projectResource->save();
		  }
		//  //TODO set other properties as well for the resource
          
        elseif (!isset($request->projectResourceId)) 
         {
			$projectResource->title = $request->title;
			$projectResource->expectedStartDate = $request->expectedStartDate;
			$projectResource->expectedEndDate = $request->expectedEndDate;
			$projectResource->actualStartDate = $request->actualStartDate;
			$projectResource->actualEndDate = $request->actualEndDate;
			$projectResource->hourlyBillingRate = $request->hourlyBillingRate;
			$projectResource->hoursPerWeek = $request->hoursPerWeek;
			$projectResource->employee_id = $request->employee_id;
			$projectResource->client_project_id = $request->clientProjectid;
			//TODO set other properties as well for the resource
            $projectResource->save();
         }
    }

        public function updateProjectRessources($clientid) {

			$Resource = ProjectResource::where('id', $clientid)->orderBy('created_at', 'asc')->get();
            return $Resource;

	}


	public function manageProjectResources($clientProjectid) {
        
        $currentProjectResources = ProjectResource::where('client_project_id', $clientProjectid)->orderBy('created_at', 'asc')
			->get();

		$availableEmployees = Employee::orderBy('created_at', 'asc')->get();
       
        return array($currentProjectResources, $availableEmployees);
    }
    
    public function deleteProjectResource($projectresource) {
	
	$projectresource->delete();
	
	}

    public function getClientProjectResourcesOnActiveProjects($employeeId)
    {
        $currentDate = date("Y-m-d");
        return  ProjectResource::where('employee_id', $employeeId)
            ->where('endDate', '>=', $currentDate )
            ->with('clientProject')
            ->get();
    }
}