<?php

namespace People\Services;

use People\Services\Interfaces\IProjectService;

class ProjectResourceDetails
{
    public $resourceName;
    public $resourceId;
    public $employee_id;
    public $projectId;
    public $expectedStartDate;
    public $expectedEndDate;
    public $actualStartDate;
    public $actualEndDate;
    public $hourlyBillingRate;
    public $hoursPerWeek;
    public $title;
}
class ProjectService implements IProjectService
{
    public function mapResourcesDetailsToClass($currentProjectResources, $isCompanyProject)
    {
        $projectResources = array();

        foreach ($currentProjectResources as $currentProjectResource) {

            $projectResourceDetails              = new ProjectResourceDetails();
            $projectResourceDetails->resourceId  = $currentProjectResource->id;
            $projectResourceDetails->employee_id = $currentProjectResource->employee_id;
            $projectResourceDetails->title       = $currentProjectResource->title;
            if ($isCompanyProject) {
                $projectResourceDetails->projectId = $currentProjectResource->company_project_id;
            } else {
                $projectResourceDetails->projectId = $currentProjectResource->client_project_id;
            }
            $projectResourceDetails->expectedStartDate = $currentProjectResource->expectedStartDate;
            $projectResourceDetails->expectedEndDate   = $currentProjectResource->expectedEndDate;
            $projectResourceDetails->actualStartDate   = $currentProjectResource->actualStartDate;
            $projectResourceDetails->actualEndDate     = $currentProjectResource->actualEndDate;
            $projectResourceDetails->hourlyBillingRate = $currentProjectResource->hourlyBillingRate;
            $projectResourceDetails->hoursPerWeek      = $currentProjectResource->hoursPerWeek;
            if ($currentProjectResource->employee_id == null) {
                $projectResourceDetails->resourceName = $currentProjectResource->title;

            } else {

                $projectResourceDetails->resourceName = $currentProjectResource->employee->firstName . ' ' . $currentProjectResource->employee->lastName;
            }
            array_push($projectResources, $projectResourceDetails);

        }
        return $projectResources;
    }
    public function getProjectStartAndEndDate($project)
    {
        $startDate = null;
        $endDate   = null;
        if (isset($project->actualStartDate)) {

            $startDate = $project->actualStartDate;
        } else {
            $startDate = $project->expectedStartDate;

        }

        if (isset($project->actualEndDate)) {

            $endDate = $project->actualEndDate;
        } else {
            $endDate = $project->expectedEndDate;

        }

        return array($startDate, $endDate);
    }
    public function getProjectDetails($projectModel, $project)
    {
        $isOnTime = $this->isProjectOnTime($project->expectedEndDate, $project->actualEndDate);
        //   $isOnBudget = $this->isProjectOnBudget($project->cost, $project->budget);

        $projectModel->projectId         = $project->id;
        $projectModel->name              = $project->name;
        $projectModel->actualStartDate   = $project->actualStartDate;
        $projectModel->actualEndDate     = $project->actualEndDate;
        $projectModel->expectedStartDate = $project->expectedStartDate;
        $projectModel->expectedEndDate   = $project->expectedEndDate;
        $projectModel->budget            = $project->budget;
        //$projectModel->cost = $project->cost;
        $projectModel->isProjectOnTime = $isOnTime;
        // $projectModel->isProjectOnBudget = $isOnBudget;
        return $projectModel;
    }

    private function isProjectOnTime($expectedEndDate, $actualEndDate)
    {
        $currentDate = date("Y-m-d");
        $isOnTime    = "Not On Time";

        if ($expectedEndDate != null) {
            if ($actualEndDate == null) {
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

    public function isProjectOnBudget($cost, $budget)
    {

        if (($cost != null) && ($budget != null)) {
            if ($cost < $budget) {
                $isOnBudget = "Project is On Budget";
            } else {
                $isOnBudget = "Project is Not On Budget";
            }
        } elseif ($cost == null) {
            $isOnBudget = "Budget Cannot determine.Please set cost ";
        } else {
            $isOnBudget = "Budget Cannot determine.Please set budget ";
        }
        return $isOnBudget;
    }

}
