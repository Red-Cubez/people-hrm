<?php

namespace People\Services\Interfaces;

interface IJobTitleService {

    public function getAllJobTitles();
    public function getEmployeeJobTilte($jobTitleId);
    public function getJobTitlesOfCompany($companyId);


}