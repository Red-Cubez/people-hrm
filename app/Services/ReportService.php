<?php

namespace People\Services;

use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IDateTimeService;
use People\Services\Interfaces\IProjectGrapher;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IReportService;

class Project
{
    public $projecId;
    public $projectName;
    public $companyId;
    public $budget;
    public $actualStartDate;
    public $actualEndDate;
    public $expectedStartDate;
    public $expectedEndDate;

}
class ProjectMonthlyTimeLine
{
    public $monthName;
    public $startDate;
    public $endDate;
    public $noOfDays;
    public $totalCost;
    public $totalRevenue;
    public $totalProfit;
    public $projectName;
    public $projectId;
    public $projectBudget;

}
class MOnthlyTimeline
{
    public $monthName;
    public $startDate;
    public $endDate;
    public $noOfDays;
    public $totalCost;
    public $totalRevenue;
    public $totalProfit;
    public $monthlyTimelineItems;
}
class ReportService implements IReportService
{
    public $ProjectGrapher;
    public $CompanyProjectService;
    public $CompanyProjectResourceService;
    public $ClientProjectService;
    public $ProjectService;
    public $ProjectResourceService;
    public $DateTimeService;

    public function __construct(IProjectGrapher $projectGrapher, ICompanyProjectService $companyProjectService, ICompanyProjectResourceService $companyProjectResourceService, IDateTimeService $dateTimeService,
        IClientProjectService $clientProjectService, IProjectService $projectService, IProjectResourceService $projectResourceService) {

        $this->ProjectGrapher                = $projectGrapher;
        $this->CompanyProjectService         = $companyProjectService;
        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ClientProjectService          = $clientProjectService;
        $this->ProjectService                = $projectService;
        $this->ProjectResourceService        = $projectResourceService;
        $this->DateTimeService               = $dateTimeService;

    }

    public function getClientProjectsTimelines($companyId, $startDate, $endDate)
    {

        $clientProjectsTimeLines = array();
        $clients                 = $this->ClientProjectService->getAllClientsOfCompanyWithProjects($companyId);
        foreach ($clients as $client) {

            foreach ($client->projects as $companyClientProject) {

                list($projectStartDate, $projectEndDate) = $this->ClientProjectService->getProjectStartAndEndDate($companyClientProject);

                if (($startDate <= $projectEndDate) && ($projectStartDate <= $endDate)
                    && ($startDate <= $endDate) && ($projectStartDate <= $projectEndDate)) {

                    $projectsTimeLines = $this->getClientProjectTimelines($companyClientProject, $startDate, $endDate);

                    array_push($clientProjectsTimeLines, $projectsTimeLines);
                }
            }

        }

        return $clientProjectsTimeLines;

    }

    public function getClientProjectTimelines($clientProject)
    {
        list($currentProjectResources) = $this->ProjectResourceService->showClientProjectResources($clientProject->id);

        // $clientProject = $this->ClientProjectService->viewClientProject($clientProjectId);

        $projectTimelines = $this->ProjectGrapher->setupProjectCost($clientProject, $currentProjectResources, false);
        if (count($projectTimelines) > 0) {

            $projectTimelines[0]->project = $clientProject;
        }

        return $projectTimelines;
    }

    public function getInternalProjectsTimelines($companyId, $startDate, $endDate)
    {
        $companyInternalProjectsTimeLines = array();
        $companyInternalProjects          = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);

        foreach ($companyInternalProjects as $companyInternalProject) {

            list($projectStartDate, $projectEndDate) = $this->CompanyProjectService->getProjectStartAndEndDate($companyInternalProject);

            if (($startDate <= $projectEndDate) && ($projectStartDate <= $endDate)
                && ($startDate <= $endDate) && ($projectStartDate <= $projectEndDate)) {

                $projectsTimeLines = $this->getInternalProjectTimelines($companyInternalProject, $startDate, $endDate);

                array_push($companyInternalProjectsTimeLines, $projectsTimeLines);
            }
        }

        return $companyInternalProjectsTimeLines;
    }

    public function getStartAndEndDateTimelines($startDate, $endDate)
    {

        $totalMonths = $this->ProjectGrapher -
        calculateMonthsBetweenTwoDates($startDate, $endDate);
        $timeLine = array();

        $startDate = date("Y-m-d", strtotime($startDate));

        $startDateInDateTime = new \DateTime($startDate);

        for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {
            $lastDateOfCurrentMonth  = 0;
            $firstDateOfCurrentMonth = 0;
            $currentMonth            = "";

            if ($monthCounter == 0) {
                $firstDateOfCurrentMonth = $startDateInDateTime;

            } else {
                $currentMonth = strtotime($startDateInDateTime->modify('+1 month')->format("Y-m-d"));

                $firstDateOfCurrentMonth = new \DateTime(date("Y-m-01", $currentMonth));
            }
            if ($monthCounter == $totalMonths) {
                $lastDateOfCurrentMonth = $endDate;

            } else {

                $lastDateOfCurrentMonth = $firstDateOfCurrentMonth->format("Y-m-t");

            }

            $projectDetails = $this->ProjectGrapher->setupProjectTimeline($firstDateOfCurrentMonth, $lastDateOfCurrentMonth);

            array_push($timeLine, $projectDetails);

        }

        return $timeLine;
    }

    public function mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines)
    {

        $sumOfCost = 0;
        $profit    = 0;
        foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
            {
                foreach ($projectsTimelines as $projectTimelines) {

                    foreach ($projectTimelines as $projectTimeline) {
                        if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {

                            $sumOfCost                     = $sumOfCost + $projectTimeline->cost;
                            $startAndEndDateTimeline->cost = $sumOfCost;

                        } else {
                            $startAndEndDateTimeline->cost = $sumOfCost;

                        }
                    }
                }
            }
        }

        return $startAndEndDateTimelines;
    }

    public function getInternalProjectTimelines($companyProject)
    {
        list($currentProjectResources) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProject->id);

        //$companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

        $projectTimelines = $this->ProjectGrapher->setupProjectCost($companyProject, $currentProjectResources, true);
        if (count($projectTimelines) > 0) {

            $projectTimelines[0]->project = $companyProject;
        }
        foreach ($projectTimelines as $projectTimeline) {
            $projectTimeline->budget = $companyProject->budget;
        }
        return $projectTimelines;
    }

    public function getInternalProjects($companyId, $startDate, $endDate)
    {

        $companyInternalProjectsTimeLines = array();
        $companyInternalProjects          = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);

        foreach ($companyInternalProjects as $companyInternalProject) {

            list($projectStartDate, $projectEndDate) = $this->CompanyProjectService->getProjectStartAndEndDate($companyInternalProject);

            if (($startDate <= $projectEndDate) && ($projectStartDate <= $endDate)
                && ($startDate <= $endDate) && ($projectStartDate <= $projectEndDate)) {

                $projectsTimeLines = $this->getInternalProjectTimelines($companyInternalProject, $startDate, $endDate);

                array_push($companyInternalProjectsTimeLines, $projectsTimeLines);
            }
        }

        return $companyInternalProjectsTimeLines;
    }
/////////////////////////////////////////////////New//////////////////////////////////////////////////
    public function startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyId)
    {

        //$this->DateTimeService->getStartAndEndDateTimelines($startDate, $endDate, $companyId);

        $totalMonths      = $this->DateTimeService->calculateMonthsBetweenTwoDates($startDate, $endDate);
        $timeLine         = array();
        $monthlyTimelines = array();

        $startDate = date("Y-m-d", strtotime($startDate));

        $startDateInDateTime = new \DateTime($startDate);

        for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {

            list($firstDateOfCurrentMonth, $lastDateOfCurrentMonth) = $this->DateTimeService->getFirstAndLastDateCurrentOfMonth($monthCounter, $totalMonths, $startDateInDateTime, $endDate);

            $monthlyTimeline = new monthlyTimeline();
            // dd($lastDateOfCurrentMonth);

            $currentMonthName           = $this->DateTimeService->getMonthNameAndYear($firstDateOfCurrentMonth->format("Y-m-d"), $lastDateOfCurrentMonth);
            $monthlyTimeline->monthName = $currentMonthName;

            $projectsMonthlyTimeLine = $this->setupTimeline($firstDateOfCurrentMonth, $lastDateOfCurrentMonth, $companyId);

            $monthlyTimeline->monthlyTimelineItems = array();

            foreach ($projectsMonthlyTimeLine as $projectMonthlyTimeLine) {
                $monthlyTimeline->totalCost = $monthlyTimeline->totalCost + $projectMonthlyTimeLine->totalCost;
                array_push($monthlyTimeline->monthlyTimelineItems, $projectMonthlyTimeLine);

            }

            array_push($monthlyTimelines, $monthlyTimeline);

        }

        dd($monthlyTimelines);

    }

    public function setupTimeline($currentMonthStartDate, $currentMonthEndDate, $companyId)
    {

        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName      = date("M-Y", strtotime($currentMonthStartDate));

        $timeline = new MOnthlyTimeline();

        $timeline->monthName = $currentMonthName;
        $timeline->startDate = $currentMonthStartDate;
        $timeline->endDate   = $currentMonthEndDate;

        $timeline->timelineItems = array();
        $projectsMonthlyTimeLine = $this->getProjectsMonthlyTimeLine($companyId, $currentMonthStartDate, $currentMonthEndDate);

        return $projectsMonthlyTimeLine;
    }

    public function getProjectsMonthlyTimeLine($companyId, $currentMonthStartDate, $currentMonthEndDate)
    {
        $projectsMonthlyTimeLine = array();

        $companyInternalProjects = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);

        foreach ($companyInternalProjects as $companyInternalProject) {

            list($projectStartDate, $projectEndDate) = $this->CompanyProjectService->getProjectStartAndEndDate($companyInternalProject);

            if (($currentMonthStartDate <= $projectEndDate) && ($projectStartDate <= $currentMonthEndDate)
                && ($currentMonthStartDate <= $currentMonthEndDate) && ($projectStartDate <= $projectEndDate)) {

                $projectWithInStartAndEndDate = $this->projectTimeline($companyInternalProject, $currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate);

                $currentMonthName = $this->DateTimeService->getMonthNameAndYear($currentMonthStartDate);

                $projectMonthlyTimeLine = new ProjectMonthlyTimeLine();

                $projectMonthlyTimeLine->totalCost     = $projectWithInStartAndEndDate;
                $projectMonthlyTimeLine->monthName     = $currentMonthName;
                $projectMonthlyTimeLine->projectName   = $companyInternalProject->name;
                $projectMonthlyTimeLine->projectId     = $companyInternalProject->id;
                $projectMonthlyTimeLine->projectBudget = $companyInternalProject->budget;
                $projectMonthlyTimeLine->startDate     = $projectStartDate;
                $projectMonthlyTimeLine->endDate       = $projectEndDate;

                array_push($projectsMonthlyTimeLine, $projectMonthlyTimeLine);
            }
        }

        return $projectsMonthlyTimeLine;

    }

    public function projectTimeline($project, $currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate)
    {

        list($projectCurrentMonthStartDate, $projectCurrentMonthEndDate) =
        $this->getCurrentMonthStartAndEndDates($currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate);

        $resources = $project->resources;
        if (count($resources) > 0) {
            $monthlyCostSum = $this->getMonthlyCostProfitAndRevenue($resources, $projectCurrentMonthStartDate, $projectCurrentMonthEndDate);

        }

        // $this->calcuateMonthlyProfit();

        //d($monthlyCostSum);

        return $monthlyCostSum;

    }

    public function getMonthlyCostProfitAndRevenue($resources, $projectCurrentMonthStartDate, $projectCurrentMonthEndDate)
    {

        $monthlyCostSum    = 0;
        $totalCostPerMonth = 0;
        foreach ($resources as $resource) {
            //dd($resources);
            list($resourceStartDate, $resourceEndDate) = $this->ProjectResourceService->getResourceStartAndEndDate($resource);

            if (($projectCurrentMonthStartDate <= $resourceEndDate) && ($resourceStartDate <= $projectCurrentMonthEndDate)
                && ($projectCurrentMonthStartDate <= $projectCurrentMonthEndDate) && ($resourceStartDate <= $resourceEndDate)) {
                list($resourceCurrentMonthStartDate, $resourceCurrentMonthEndDate) =
                $this->getCurrentMonthStartAndEndDates($projectCurrentMonthStartDate, $projectCurrentMonthEndDate, $resourceStartDate, $resourceEndDate);

                $difference = $this->DateTimeService->calculateDifferenceBetweenTwoDates(date("Y-m-d", strtotime($resourceCurrentMonthStartDate)), date("Y-m-d", strtotime($resourceCurrentMonthEndDate)));

                $weeksWorkedInCurrentMonth = ($difference->days + 1) / 7;

                $costPerMonth = $weeksWorkedInCurrentMonth * ($resource->hourlyBillingRate) * ($resource->hoursPerWeek);

                $totalCostPerMonth = $totalCostPerMonth + $costPerMonth;
                $monthlyCostSum    = round($totalCostPerMonth, 2);

            }
        }

        return $monthlyCostSum;

    }

    public function getCurrentMonthStartAndEndDates($currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate)
    {
        $projectCurrentMonthStartDate = null;
        $projectCurrentMonthEndDate   = null;
        if ($currentMonthStartDate >= $startDate) {
            $projectCurrentMonthStartDate = $currentMonthStartDate;
        } elseif ($currentMonthStartDate < $startDate) {
            $projectCurrentMonthStartDate = $startDate;

        }

        if ($currentMonthEndDate <= $endDate) {
            $projectCurrentMonthEndDate = $currentMonthEndDate;

        } elseif ($currentMonthEndDate > $endDate) {
            $projectCurrentMonthEndDate = $endDate;

        }

        return array($projectCurrentMonthStartDate, $projectCurrentMonthEndDate);

    }

    public function setupProjectTimeline($currentMonthStartDate, $currentMonthEndDate)
    {

        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName      = date("M-Y", strtotime($currentMonthStartDate));

        $dateDiff = $this->calculateDiffernceBetweenTwoDates($currentMonthStartDate, $currentMonthEndDate);

        $projectDetails = new ProjectTimeline();

        $projectDetails->monthName = $currentMonthName;
        $projectDetails->startDate = $currentMonthStartDate;
        $projectDetails->endDate   = $currentMonthEndDate;
        $projectDetails->noOfDays  = $dateDiff->days;
        $projectDetails->cost      = 0;

        return $projectDetails;
    }
    // public function projectWithIn($currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate)
    // {

    // }

    // public function getInternalProjectTimelines111111($companyProject, $currentMonthStartDate, $currentMonthEndDate)
    // {

    //     list($currentProjectResources) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProject->id);

    //     //$companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

    //     $projectTimelines = $this->setupProjectCost($companyProject, $currentProjectResources, $currentMonthStartDate, $currentMonthEndDate);
    //     if (count($projectTimelines) > 0) {

    //         $projectTimelines[0]->project = $companyProject;
    //     }
    //     foreach ($projectTimelines as $projectTimeline) {
    //         $projectTimeline->budget = $companyProject->budget;
    //     }
    //     return $projectTimelines;
    // }
    public function getMonthlyProfit($startAndEndDateTimelines, $projectsTimelines)
    {

        $budget    = 0;
        $profit1   = 0;
        $profit    = 0;
        $sumOfCost = 0;

        foreach ($projectsTimelines as $projectTimelines) {

            if (count($projectTimelines) > 0) {
                $budget = $budget + $projectTimelines[0]->project->budget;
            }
        }

        foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {

            foreach ($projectsTimelines as $projectTimelines) {

                foreach ($projectTimelines as $projectTimeline) {
                    if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {

                        $cost = $startAndEndDateTimeline->cost;

                        $profit = $budget - ($cost);

                        $profit1                         = 1;
                        $startAndEndDateTimeline->profit = $profit;
                    } else {
                        $startAndEndDateTimeline->profit = $profit;
                    }

                }

            }
        }

        return $startAndEndDateTimelines;
    }
    public function getTotalRevenue($startAndEndDateTimelines, $projectsTimelines)
    {
        $sumOfCost = 0;
        $profit    = 0;
        $budget    = 0;
        $revenue   = 0;
        //  dd($projectsTimelines);
        foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
            {
                foreach ($projectsTimelines as $projectTimelines) {

                    $budget = $projectTimelines[0]->budget;
                    //   $revenue =
                    foreach ($projectTimelines as $projectTimeline) {
                        if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {

                            //$sumOfCost                     = $sumOfCost + $budget;
                            $revenue                          = $budget;
                            $startAndEndDateTimeline->revenue = $revenue;

                        } else {
                            $revenue                          = $revenue;
                            $startAndEndDateTimeline->revenue = $revenue;

                        }
                    }
                }
            }
        }

        return $startAndEndDateTimelines;

        // return $startAndEndDateTimelines;
        // foreach($projectTimelines as)
        //////////

        // $budget  = 0;
        // $revenue = array();
        // foreach ($projectsTimelines as $projectTimelines) {

        //     foreach ($projectTimelines as $projectTimeline) {
        //         if (isset($projectTimeline->project)) {
        //             $budget = $budget + $projectTimeline->project->budget;

        //             array_push($revenue,$budget);

        //         }
        //     }
        // }

        // dd($revenue);

        ///////////////////////////////////////////////////////////////////////////

        // $revenue = 0;
        // $budget  = 0;
        // $i       = 1;

        // foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
        //     foreach ($projectsTimelines as $projectTimelines) {

        //         foreach ($projectTimelines as $projectTimeline) {
        //             if (isset($projectTimeline->project)) {
        //                 $budget                           = $projectTimeline->project->budget;

        //             } else {
        //                 $revenue = $budget;

        //             }
        //             if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {

        //                 $startAndEndDateTimeline->revenue = $revenue+$budget;
        //                // dd($$revenue+$budget)

        //             } else {
        //                 $startAndEndDateTimeline->revenue = $revenue;

        //             }
        //         }
        //     }
        // }

        // return $startAndEndDateTimelines;

    }

}
