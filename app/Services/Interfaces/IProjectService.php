<?php

namespace People\Services\Interfaces;

interface IProjectService
{
    public function getClientProjectAndCompanyProjectDetails($projectModel, $project, $isOnTime, $isOnBudget);

}
