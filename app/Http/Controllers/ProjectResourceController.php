<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Client;
use People\Models\ClientProject;
use People\Models\Employee;
use People\Models\ProjectResource;

class ProjectResourceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//TODO need to perform eagar loaging in this context
		//TODO only get project resources for a particular client
		$currentProjectResources = ProjectResource::orderBy('created_at', 'asc')->get();

		//TODO get resources based on availibility
		$availableEmployees = Employee::orderBy('created_at', 'asc')->get();

		return view('projectResources.index', [
			'projectResources' => $currentProjectResources,
			'availableEmployees' => $availableEmployees,
		]);
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
		$projectResource = new ProjectResource();
		//TODO get the relative project id
		$projectResource->client_project_id = 1;

		$projectResource->employee_id = $request->employee_id;

		//TODO set other properties as well for the resource
		$projectResource->save();
//
		return redirect('/projectresources');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function show(ClientProject $clientProject) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ClientProject $clientProject) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ClientProject $clientProject) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\ProjectResource  $projectresource
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ProjectResource $projectresource) {
		$projectresource->delete();
		return redirect('/projectresources');
	}
}
