<?php

namespace People\Services;

use People\Services\Interfaces\IProjectService;

class ProjectService implements IProjectService
{
    public function getClientProjectAndCompanyProjectDetails($projectModel, $project, $isOnTime, $isOnBudget)
    {
        $projectModel->projectId = $project->id;
        $projectModel->name = $project->name;
        $projectModel->actualStartDate = $project->actualStartDate;
        $projectModel->actualEndDate = $project->actualEndDate;
        $projectModel->expectedStartDate = $project->expectedStartDate;
        $projectModel->expectedEndDate = $project->expectedEndDate;
        $projectModel->budget = $project->budget;
        $projectModel->cost = $project->cost;
        $projectModel->isProjectOnTime = $isOnTime;
        $projectModel->isProjectOnBudget = $isOnBudget;
        return $projectModel;
    }
}
