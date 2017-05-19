<?php

namespace People\Services;

use People\Models\JobTitle;
use People\Services\Interfaces\IJobTitleService;

class JobTitleService implements IJobTitleService
{
    public function getAllJobTitles()
    {

        $jobTitles = JobTitle::all();

        return $jobTitles;

    }

    public function getEmployeeJobTilte($jobTitleId)
    {
        $jobTitle = JobTitle::find($jobTitleId);

        return $jobTitle->title;
    }

    public function getJobTitlesOfCompany($companyId)
    {
        $companyJobTitles=JobTitle::where('company_id',$companyId)->get();

        return $companyJobTitles;
    }

}
