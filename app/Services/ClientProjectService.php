<?php

namespace People\Services;

use People\Models\Client;
use People\Models\ClientProject;
use People\Models\Company;
use People\PresentationModels\ClientProject\ViewClientProjectModel;
use People\Services\Interfaces\IClientProjectService;
use People\services\Interfaces\IProjectService;

class ClientProjectService implements IClientProjectService
{
    public $ProjectService;

    public function __construct(IProjectService $projectService)
    {

        $this->ProjectService = $projectService;
    }

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

        $clientProjectModel = new ViewClientProjectModel();

        return $this->ProjectService->getProjectDetails($clientProjectModel, $clientProject);
    }
    public function getClientProjectDetails($clientProjectId)
    {

        $project = ClientProject::find($clientProjectId);
        if (isset($project)) {
            return $project;
        } else {
            return null;
        }
    }

    public function manageClientProjects($clientid)
    {

        $clientProjects = ClientProject::where('client_id', $clientid)->orderBy('created_at', 'asc')->get();
        return $clientProjects;
    }

    public function createClientProject($request)
    {

        $clientProject            = $this->createOrUpdateClientProject($request, null);
        $clientProject->client_id = $request->clientId;
        $clientProject->save();

        return $clientProject;
    }

    public function createOrUpdateClientProject($request, $clientProject)
    {
        if (!isset($clientProject)) {
            $clientProject = new ClientProject();
        }

        $clientProject->name              = $request->name;
        $clientProject->expectedStartDate = $request->expectedStartDate;
        $clientProject->expectedEndDate   = $request->expectedEndDate;
        $clientProject->actualStartDate   = $request->actualStartDate;
        $clientProject->actualEndDate     = $request->actualEndDate;
        $clientProject->budget            = $request->budget;
        $clientProject->cost              = $request->cost;

        return $clientProject;
    }

    public function updateClientProject($request, $clientproject)
    {
        $clientProject = $this->createOrUpdateClientProject($request, $clientproject);
        $clientProject->save();

        return $clientProject;
    }

    public function getAllClientsOfCompanyWithProjects($companyId)
    {
        $company = Company::find($companyId);

        if (isset($company)) {
            $client = Client::orderBy('created_at', 'asc')->with('projects')->where('company_id', $companyId)->get();

            return $client;
        } else {
            return null;
        }
    }

    public function getProjectStartAndEndDate($project)
    {
        $startDate = null;
        $endDate   = null;
        if (isset($project->actualStartDate)) {

            $startDate = $project->actualStartDate;
        } else {
            $startDate = $project->expectedStartDate;

        }

        if (isset($project->actualEndDate)) {

            $endDate = $project->actualEndDate;
        } else {
            $endDate = $project->expectedEndDate;

        }

        return array($startDate, $endDate);
    }
    public function getAllClientProjectsOfCompany($companyId)
    {
        $clientProjects = array();
        $company        = Company::find($companyId);
        $clients        = Client::where('company_id', $companyId)->with('projects')->get();

        foreach ($clients as $client) {
            foreach ($client->projects as $project) {
                array_push($clientProjects, $project);
            }

        }

        if (isset($clientProjects)) {
            return $clientProjects;
        } else {
            return null;
        }

    }
    public function getAllInternalProjectsOfCompany($companyId)
    {
        $companyProjects = CompanyProject::orderBy('created_at', 'asc')->where('company_id', $companyId)->get();

        if (isset($companyProjects)) {
            return $companyProjects;
        } else {
            return null;
        }

    }
}
