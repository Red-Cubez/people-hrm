<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Project;
use People\Models\Company;
use People\Models\CompanyProject;

class CompanyProjectController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$companyprojects = CompanyProject::orderBy('created_at', 'asc')->get();
		return view('companyprojects.index', ['companyprojects' => $companyprojects]);
		//dd($companyprojects);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	public function showCompanyProject($companyId) {

		// dd($company);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
		$companyProject = new CompanyProject();
		$companyProject->name = $request->name;
		$companyProject->expectedStartDate = $request->expectedStartDate;
		$companyProject->expectedEndDate = $request->expectedEndDate;
		$companyProject->actualStartDate = $request->actualStartDate;
		$companyProject->actualEndDate = $request->actualEndDate;
		$companyProject->budget = $request->budget;
		$companyProject->cost = $request->cost;
		//TODO These properties need to be set from fields
		//TODO this value needs to come from the correct client Project
		//dd($request);
		$companyProject->company_id = $request->companyid;
		$companyProject->save();

		return redirect('/companyprojects');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(CompanyProject $companyproject) {

		return view('companyProjects/editProjectForm', ['companyproject' => $companyproject]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, CompanyProject $companyproject) {
		//
		$companyproject->name = $request->name;
		$companyproject->expectedStartDate = $request->expectedStartDate;
		$companyproject->expectedEndDate = $request->expectedEndDate;
		$companyproject->actualStartDate = $request->actualStartDate;
		$companyproject->actualEndDate = $request->actualEndDate;
		$companyproject->budget = $request->budget;
		$companyproject->cost = $request->cost;
		$companyproject->save();
		return redirect('/companyprojects');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(CompanyProject $companyproject) {
		//
		$companyproject->delete();
		return redirect('/companyprojects');
	}

    public function manageProject($companyid) {
    	

		$companyProjects = CompanyProject::where('company_id', $companyid)->orderBy('created_at', 'asc')->get();
	  // dd($companyProjects);
		
		return view('companyprojects.index',['companyProjects' => $companyProjects,'companyid' => $companyid,]);
	}





}

