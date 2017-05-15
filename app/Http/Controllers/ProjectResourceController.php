<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Client;
use People\Models\ClientProject;
use People\Models\Employee;
use People\Models\ProjectResource;
use People\Services\ProjectResourceService;
use People\Services\Interfaces\IProjectResourceService;


class ProjectResourceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response

	 */
    public $ProjectResourceService;

	public function __construct(IProjectResourceService $projectResourceService) {

		$this->ProjectResourceService = $projectResourceService;
	}

	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->ProjectResourceService->saveOrUpdateProjectResource($request);
		
		return redirect('/clientprojects/' . $request->clientProjectid . '/projectresources');

	}

	public function manageressources($clientProjectid) {

		//TODO get resources based on availibility
		list($currentProjectResources,$availableEmployees) = $this->ProjectResourceService->manageProjectResources($clientProjectid);

        return view('projectResources.index', [
			'projectResources' => $currentProjectResources,
			'availableEmployees' => $availableEmployees,
			'clientProjectid' => $clientProjectid,
		]);

	}
	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function show(ProjectResource $projectresource) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ProjectResource $projectresource) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ProjectResource $projectresource) {

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\ProjectResource  $projectresource
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ProjectResource $projectresource, Request $request) {

        $this->ProjectResourceService->deleteProjectResource($projectresource);
		
	    return redirect('/clientprojects/' . $projectresource->client_project_id . '/projectresources');
	}

	public function updateressources($projectResourceid) {
		$Resource = $this->ProjectResourceService->updateProjectRessources($projectResourceid);

		return view('projectResources.updateResource', [
			'projectresources' => $Resource

		]);
	}

}
