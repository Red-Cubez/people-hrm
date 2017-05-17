<?php

namespace People\Services;
use People\Models\ClientProject;
use People\Services\Interfaces\IClientProjectService;
use People\PresentationModels\ClientProject\ViewClientProjectModel;

class ClientProjectService implements IClientProjectService {

	public function getClientProjects() {

		$clientProjects = ClientProject::orderBy('created_at', 'asc')->get();
		return $clientProjects;
	}

	public function deleteClientProject($clientproject) {
		$clientid = $clientproject->client_id;
		$clientproject->delete();
		return $clientid;

	}

	private function isProjectOnTime($clientProject) {
		$currentDate = date("Y-m-d");
        $isOnTime="Not On";
		 if (($clientProject->actualEndDate) != NULL ) {
             if ((($clientProject->actualEndDate) >= $currentDate)) {

                 $isOnTime = "On";
             }
         }

		 elseif ($clientProject->expectedEndDate != NULL &&($clientProject->actualEndDate == NULL)) {

             if (($clientProject->expectedEndDate) >= $currentDate) {
                 $isOnTime = "On";
             }
         }

		 else {
                 $isOnTime="Not On";
		 }
        return $isOnTime;

	}
	private function isProjectOnBudget($clientProject)
    {
        $cost=$clientProject->cost;
        $budget=$clientProject->budget;

        if($cost<$budget)
        {
            $isOnBudget="On";
        }
        else{
            $isOnBudget="Not On";
        }
        return $isOnBudget;
    }

	public function viewClientProject($clientProjectId) {


		$clientProject = ClientProject::find($clientProjectId);

        $isOnTime = $this->isProjectOnTime($clientProject);
        $isOnBudget = $this->isProjectOnBudget($clientProject);

        $clientProjectModel =new ViewClientProjectModel();

        $clientProjectModel->id=$clientProject->id;
		$clientProjectModel->name=$clientProject->name;
		$clientProjectModel->actualStartDate=$clientProject->actualStartDate;
        $clientProjectModel->actualEndDate=$clientProject->actualEndDate;
        $clientProjectModel->expectedStartDate=$clientProject->expectedStartDate;
        $clientProjectModel->expectedEndDate=$clientProject->expectedEndDate;
		$clientProjectModel->budget=$clientProject->budget;
        $clientProjectModel->cost=$clientProject->cost;
        $clientProjectModel->isProjectOnTime=$isOnTime;
        $clientProjectModel->isProjectOnBudget=$isOnBudget;

		return $clientProjectModel;
	}

	public function manageClientProjects($clientid) {

		$clientProjects = ClientProject::where('client_id', $clientid)->orderBy('created_at', 'asc')->get();
		return $clientProjects;
	}

	public function createClientProject($request) {

		$clientProject = $this->createOrUpdateClientProject($request, null);
		$clientProject->client_id = $request->clientid;
		$clientProject->save();

		return $clientProject;

	}

	public function createOrUpdateClientProject($request, $clientProject) {

		if (!isset($clientProject)) {

			$clientProject = new ClientProject();
		}

		$clientProject->name = $request->name;
		$clientProject->expectedStartDate = $request->expectedStartDate;
		$clientProject->expectedEndDate = $request->expectedEndDate;
		$clientProject->actualStartDate = $request->actualStartDate;
		$clientProject->actualEndDate = $request->actualEndDate;
		$clientProject->budget = $request->budget;
		$clientProject->cost = $request->cost;

		return $clientProject;
	}

	public function updateClientProject($request, $clientproject) {

		$clientProject = $this->createOrUpdateClientProject($request, $clientproject);
		$clientProject->save();

		return $clientProject;
	}
}
