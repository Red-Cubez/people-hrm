<?php

namespace People\Services\Interfaces;

interface IJobTitleService
{

    public function getAllJobTitles();

    public function getEmployeeJobTilte($jobTitleId);

    public function getJobTitlesOfCompany($companyId);

    public function getJobTitleDetails($jobTitleId);

    public function updateJobTitle($request, $jobTitleId);

    public function deleteJobTitle($jobTitleId);

    public function saveJobTitle($request);


}