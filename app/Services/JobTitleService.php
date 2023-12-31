<?php

namespace People\Services;

use People\Models\JobTitle;
use People\Services\Interfaces\IJobTitleService;

class JobTitleService implements IJobTitleService {
	public function getAllJobTitles() {

		$jobTitles = JobTitle::all();

		return $jobTitles;

	}
	public function updateJobTitle($request, $jobTitleId) {
		//update
		$jobTitle = JobTitle::find($jobTitleId);

		$jobTitle->title = $request->name;
		$jobTitle->save();
		return $jobTitle;

	}

	public function getJobTitleDetails($jobTitleId) {
		$jobTitle = JobTitle::find($jobTitleId);
		return $jobTitle;
	}

	public function saveJobTitle($request) {
		$companyJobTitle = new JobTitle();

		$companyJobTitle->title = $request->name;
		$companyJobTitle->company_id = $request->companyId;

		$companyJobTitle->save();
		return $companyJobTitle;
	}

	public function deleteJobTitle($jobTitleId) {
		$jobTitle = JobTitle::find($jobTitleId);
		$companyId = $jobTitle->company_id;

		$jobTitle->delete();


	}

	public function getEmployeeJobTilte($jobTitleId) {
		$jobTitle = JobTitle::find($jobTitleId);

		return $jobTitle->title;
	}

	public function getJobTitlesOfCompany($companyId) {
		$companyJobTitles = JobTitle::where('company_id', $companyId)->get();

		return $companyJobTitles;
	}

}
