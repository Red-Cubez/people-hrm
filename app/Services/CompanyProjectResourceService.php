<?php

namespace People\Services;
use People\Models\CompanyProjectResource;
use People\Models\Employee;
use People\Services\Interfaces\ICompanyProjectResourceService;

class CompanyProjectResourceService implements ICompanyProjectResourceService {

	public function showCompanyProjectResources($companyProjectId) {

		$currentProjectResources = CompanyProjectResource::where('company_project_id', $companyProjectId)->orderBy('created_at', 'asc')
			->get();

		$availableEmployees = Employee::orderBy('created_at', 'asc')->get();

		return array($currentProjectResources, $availableEmployees);

	}

	public function saveOrUpdateCompanyProjectResource($request) {

		if (!isset($request->projectResourceId)) {

			$CompanyProjectResource = new CompanyProjectResource();

		}

		if (isset($request->projectResourceId)) {

			$CompanyProjectResource = CompanyProjectResource::find($request->projectResourceId);

		}
		//  //TODO get the relative project id

		if (isset($request->projectResourceId)) {
			//update
			;
			$CompanyProjectResource->title = $request->title;
			$CompanyProjectResource->expectedStartDate = $request->expectedStartDate;
			$CompanyProjectResource->expectedEndDate = $request->expectedEndDate;
			$CompanyProjectResource->actualStartDate = $request->actualStartDate;
			$CompanyProjectResource->actualEndDate = $request->actualEndDate;
			$CompanyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
			$CompanyProjectResource->hoursPerWeek = $request->hoursPerWeek;

			$CompanyProjectResource->save();

		}
		//  //TODO set other properties as well for the resource

		elseif (!isset($request->projectResourceId)) {
			//save
			$CompanyProjectResource->title = $request->title;
			$CompanyProjectResource->expectedStartDate = $request->expectedStartDate;
			$CompanyProjectResource->expectedEndDate = $request->expectedEndDate;
			$CompanyProjectResource->actualStartDate = $request->actualStartDate;
			$CompanyProjectResource->actualEndDate = $request->actualEndDate;
			$CompanyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
			$CompanyProjectResource->hoursPerWeek = $request->hoursPerWeek;
			$CompanyProjectResource->employee_id = $request->employee_id;
			$CompanyProjectResource->company_project_id = $request->companyProjectId;
			//TODO set other properties as well for the resource

			$CompanyProjectResource->save();

		}

	}

	public function showEditForm($companyProjectId) {

		$Resource = CompanyProjectResource::where('id', $companyProjectId)->orderBy('created_at', 'asc')->get();
		return $Resource;
	}

	public function deleteCompanyProjectResource($companyprojectresource) {

		$companyprojectresource->delete();

	}

}
