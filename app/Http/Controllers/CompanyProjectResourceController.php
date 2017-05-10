<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProjectResource;
use People\Services\CompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectResourceService;

class CompanyProjectResourceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public $CompanyProjectResourceService;

	public function __construct(ICompanyProjectResourceService $companyProjectResourceService) {

		$this->CompanyProjectResourceService = $companyProjectResourceService;
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

		$this->CompanyProjectResourceService->saveOrUpdateCompanyProjectResource($request);

		return redirect('/companyprojectresources/' . $request->companyProjectId);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($companyProjectId) {

		list($currentProjectResources, $availableEmployees) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);

		return view('CompanyProjectResources.index', [
			'projectResources' => $currentProjectResources,
			'availableEmployees' => $availableEmployees,
			'companyProjectId' => $companyProjectId,

		]);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($companyProjectId) {

		$Resource = $this->CompanyProjectResourceService->showEditForm($companyProjectId);

		return view('CompanyProjectResources.updateResource', [
			'projectresources' => $Resource,
		]);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function destroy(CompanyProjectResource $companyprojectresource, Request $request) {

		$this->CompanyProjectResourceService->deleteCompanyProjectResource($companyprojectresource);

		return redirect('/companyprojectresources/' . $request->companyProjectId);
	}

}
