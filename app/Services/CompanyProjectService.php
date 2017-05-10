<?php

namespace People\Services;
use People\Models\CompanyProject;
use People\Services\Interfaces\ICompanyProjectService;

class CompanyProjectService implements ICompanyProjectService {

	public function getAllCompanyProjects() {

		$companyprojects = CompanyProject::orderBy('created_at', 'asc')->get();
		return $companyprojects;
	}

	public function saveCompanyProject($request) {

		$companyProject = new CompanyProject();

		$companyProject->name = $request->name;
		$companyProject->expectedStartDate = $request->expectedStartDate;
		$companyProject->expectedEndDate = $request->expectedEndDate;
		$companyProject->actualStartDate = $request->actualStartDate;
		$companyProject->actualEndDate = $request->actualEndDate;
		$companyProject->budget = $request->budget;
		$companyProject->cost = $request->cost;
		$companyProject->company_id = $request->companyid;
		//TODO These properties need to be set from fields
		//TODO this value needs to come from the correct client Project

		$companyProject->save();

	}

	public function updateCompanyProject($request, $companyproject) {

		$companyproject->name = $request->name;
		$companyproject->expectedStartDate = $request->expectedStartDate;
		$companyproject->expectedEndDate = $request->expectedEndDate;
		$companyproject->actualStartDate = $request->actualStartDate;
		$companyproject->actualEndDate = $request->actualEndDate;
		$companyproject->budget = $request->budget;
		$companyproject->cost = $request->cost;

		$companyproject->save();

	}

	public function deleteCompanyProject($companyproject) {

		$companyproject->delete();

	}

	public function manageProject($companyid) {

		$companyProjects = CompanyProject::where('company_id', $companyid)->orderBy('created_at', 'asc')->get();

		return $companyProjects;
	}

}
