<?php

namespace People\Services;

use People\Models\ClientProject;
use People\PresentationModels\ClientProject\ViewClientProjectModel;
use People\Services\Interfaces\IClientProjectService;

class ClientProjectService implements IClientProjectService
{

    public function getClientProjects()
    {

        $clientProjects = ClientProject::orderBy('created_at', 'asc')->get();
        return $clientProjects;
    }

    public function deleteClientProject($clientproject)
    {
        $clientid = $clientproject->client_id;
        $clientproject->delete();
        return $clientid;
    }

    public function viewClientProject($clientProjectId)
    {

        $clientProject = ClientProject::find($clientProjectId);

        $isOnTime = $this->isProjectOnTime($clientProject);
        $isOnBudget = $this->isProjectOnBudget($clientProject);

        $clientProjectModel = new ViewClientProjectModel();

        $clientProjectModel->id = $clientProject->id;
        $clientProjectModel->name = $clientProject->name;
        $clientProjectModel->actualStartDate = $clientProject->actualStartDate;
        $clientProjectModel->actualEndDate = $clientProject->actualEndDate;
        $clientProjectModel->expectedStartDate = $clientProject->expectedStartDate;
        $clientProjectModel->expectedEndDate = $clientProject->expectedEndDate;
        $clientProjectModel->budget = $clientProject->budget;
        $clientProjectModel->cost = $clientProject->cost;
        $clientProjectModel->isProjectOnTime = $isOnTime;
        $clientProjectModel->isProjectOnBudget = $isOnBudget;

        return $clientProjectModel;
    }

    private function isProjectOnTime($clientProject)
    {
        $currentDate = date("Y-m-d");
        $isOnTime = "Not On Time";

        if ($clientProject->expectedEndDate != NULL) {
            if ($clientProject->actualEndDate == NULL) {
                if (($clientProject->expectedEndDate) >= $currentDate) {
                    $isOnTime = "On Time";
                } else {
                    $isOnTime = "Not On Time";
                }
            } else {

                if ($clientProject->actualEndDate <= $clientProject->expectedEndDate) {
                    $isOnTime = "On Time";
                    if (($clientProject->actualEndDate <= $currentDate) && ($clientProject->actualEndDate == $clientProject->expectedEndDate)) {
                        $isOnTime = "Completed ";
                    } elseif (($clientProject->actualEndDate <= $currentDate) && ($clientProject->actualEndDate < $clientProject->expectedEndDate)) {
                        $isOnTime = "Completed Before Time ";
                    }

                }
            }
        } //This scenario should not occur. The validation should stop user from have a blank expected end date
        else {
            $isOnTime = "Cannot determine time. Please set expected end date";
        }
        return $isOnTime;
    }

    private function isProjectOnBudget($clientProject)
    {
        $cost = $clientProject->cost;
        $budget = $clientProject->budget;
        if (($cost != NULL) && ($budget != NULL)) {
            if ($cost < $budget) {
                $isOnBudget = "Project is On Budget";
            } else {
                $isOnBudget = "Project is Not On Budget";
            }
        } elseif ($cost == NULL) {
            $isOnBudget = "Budget Cannot determine.Please set cost ";
        } else {
            $isOnBudget = "Budget Cannot determine.Please set budget ";
        }
        return $isOnBudget;
    }

    public function manageClientProjects($clientid)
    {

        $clientProjects = ClientProject::where('client_id', $clientid)->orderBy('created_at', 'asc')->get();
        return $clientProjects;
    }

    public function createClientProject($request)
    {

        $clientProject = $this->createOrUpdateClientProject($request, null);
        $clientProject->client_id = $request->clientid;
        $clientProject->save();

        return $clientProject;

    }

    public function createOrUpdateClientProject($request, $clientProject)
    {

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

    public function updateClientProject($request, $clientproject)
    {

        $clientProject = $this->createOrUpdateClientProject($request, $clientproject);
        $clientProject->save();

        return $clientProject;
    }
}
