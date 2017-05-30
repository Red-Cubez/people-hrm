<?php

namespace People\Services;

use People\Models\ClientProject;
use People\PresentationModels\ClientProject\ViewClientProjectModel;
use People\Services\Interfaces\IClientProjectService;
use People\services\Interfaces\IProjectService;

class ClientProjectService implements IClientProjectService {
	public $ProjectService;

	public function __construct(IProjectService $projectService) {

		$this->ProjectService = $projectService;
	}

	public function getClientProjects() {
		$clientProjects = ClientProject::orderBy('created_at', 'asc')->get();
		return $clientProjects;
	}

	public function deleteClientProject($clientproject) {
		$clientid = $clientproject->client_id;
		$clientproject->delete();
		return $clientid;
	}

	public function viewClientProject($clientProjectId) {
		$clientProject = ClientProject::find($clientProjectId);

		$clientProjectModel = new ViewClientProjectModel();

		return $this->ProjectService->getProjectDetails($clientProjectModel, $clientProject);
	}
	public function getClientProjectDetails($clientProjectId) {

		return ClientProject::find($clientProjectId);
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
