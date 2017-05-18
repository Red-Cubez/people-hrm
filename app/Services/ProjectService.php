<?php

namespace People\Services;

use People\Services\Interfaces\IProjectService;

class ProjectService implements IProjectService
{
    public function getProjectDetails($projectModel, $project)
    {
        $isOnTime = $this->isProjectOnTime($project->expectedEndDate, $project->actualEndDate);
        $isOnBudget = $this->isProjectOnBudget($project->cost, $project->budget);

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

    private function isProjectOnTime($expectedEndDate, $actualEndDate)
    {
        $currentDate = date("Y-m-d");
        $isOnTime = "Not On Time";

        if ($expectedEndDate != NULL) {
            if ($actualEndDate == NULL) {
                if (($expectedEndDate) >= $currentDate) {
                    $isOnTime = "On Time";
                } else {
                    $isOnTime = "Not On Time";
                }
            } else {

                if ($actualEndDate <= $expectedEndDate) {
                    $isOnTime = "On Time";
                    if ($actualEndDate <= $currentDate) {
                        $isOnTime = "Completed ";
                    } elseif ($actualEndDate < $expectedEndDate) {
                        $isOnTime = "Completed Before Time ";
                    }

                }
            }
        } //This scenario should not occur. The validation should stop user from have a blank expected end date
        else {
            $isOnTime = "Cannot determine time. Please set expected end date";
        }
        return $isOnTime;
    }

    private function isProjectOnBudget($cost, $budget)
    {

        if (($cost != NULL) && ($budget != NULL)) {
            if ($cost < $budget) {
                $isOnBudget = "Project is On Budget";
            } else {
                $isOnBudget = "Project is Not On Budget";
            }
        } elseif ($cost == NULL) {
            $isOnBudget = "Budget Cannot determine.Please set cost ";
        } else {
            $isOnBudget = "Budget Cannot determine.Please set budget ";
        }
        return $isOnBudget;
    }

}
