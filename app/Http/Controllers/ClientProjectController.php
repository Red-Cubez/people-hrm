<?php
namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Client;
use People\Models\ClientProject;
use People\Services\ClientProjectService;
use People\Services\Interfaces\IClientProjectService;

class ClientProjectController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public $ClientProjectService;

	public function __construct(IClientProjectService $clientprojectService) {

		$this->ClientProjectService = $clientprojectService;
	}

	public function index() {
		//TODO only get projects for a particular client
		$clientProjects = $this->ClientProjectService->getClientProjects();

		return view('clientprojects.index', ['clientProjects' => $clientProjects]);
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

		$clientProject = $this->ClientProjectService->createClientProject($request);
		//TODO These properties need to be set from fields
		//TODO this value needs to come from the correct client Project

		return redirect('/clients/' . $clientProject->client_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\ClientProject  $clientProject
	 * @return \Illuminate\Http\Response
	 */
	public function show(ClientProject $clientproject) {
		
		return view('clientProjects/clientProjectEditForm', ['clientProject' => $clientproject]);
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
	public function update(Request $request, ClientProject $clientproject) {

		$clientid = $this->ClientProjectService->updateClientProject($request, $clientproject);

		return redirect('/clients/' . $clientproject->client_id);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\ClientProject  $clientproject
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ClientProject $clientproject) {
		$clientid = $this->ClientProjectService->deleteClientProject($clientproject);

		return redirect('/clients/' . $clientid);
	}

	public function manageProject($clientid) {
		$clientProjects = $this->ClientProjectService->manageClientProjects($clientid);

		return view('clientprojects.index',
			['clientProjects' => $clientProjects,
				'clientid' => $clientid,
			]);
	}
}
