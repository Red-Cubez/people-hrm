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
use People\Services\Resources\RandomColorGenerator;

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
    public $projectId;
    public $projectName;
    public $monthName;
    public $startDate;
    public $endDate;
    public $totalRevenue;
    public $totalCost;
    public $totalProfit;

    public $projectBudget;

}
class ResourceMonthlyDetail
{
    public $resourceId;
    public $resourceName;
    public $monthName;
    public $resourceStartDate;
    public $resourceEndDate;
    public $resourceCost;

}
class MonthlyTimeline
{
    public $monthName;
    public $startDate;
    public $endDate;
    public $totalRevenue;
    public $totalCost;
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

        $totalMonths = $this->ProjectGrapher->calculateMonthsBetweenTwoDates($startDate, $endDate);
        $timeLine    = array();

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
    public function startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $projects)
    {

        $totalMonths = $this->DateTimeService->calculateMonthsBetweenTwoDates($startDate, $endDate);

        $monthlyTimelines = array();
        // $projectNames     = array();

        //$startDate           = date("Y-m-d", strtotime($startDate));

        $monthlyCost         = 0;
        $startDateInDateTime = new \DateTime($startDate);

        $totalRevenue = 0;
        $totalProfit  = 0;
        for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {

            list($firstDateOfCurrentMonth, $lastDateOfCurrentMonth) = $this->DateTimeService->getFirstAndLastDateCurrentOfMonth($monthCounter, $totalMonths, $startDateInDateTime, $endDate);

            $currentMonthName = $this->DateTimeService->getMonthNameAndYear($firstDateOfCurrentMonth->format("Y-m-d"), $lastDateOfCurrentMonth);

            $monthlyTimeline = new monthlyTimeline();

            $monthlyTimeline->monthName = $currentMonthName;
            $monthlyTimeline->startDate = $firstDateOfCurrentMonth->format("Y-m-d");
            $monthlyTimeline->endDate   = $lastDateOfCurrentMonth;
//dd($);
            $projectsMonthlyTimeLine = $this->setupTimeline($firstDateOfCurrentMonth, $lastDateOfCurrentMonth, $projects, $startDate, $endDate);

            $monthlyTimeline->monthlyTimelineItems = array();

            foreach ($projectsMonthlyTimeLine as $projectMonthlyTimeLine) {

                // $monthlyCost = $monthlyCost + $monthlyTimeline->totalCost + $projectMonthlyTimeLine->totalCost;
                $monthlyCost = $monthlyCost + $projectMonthlyTimeLine->totalCost;

                $monthlyTimeline->totalCost = $monthlyCost;

                $monthlyTimeline->totalRevenue = $totalRevenue + $projectMonthlyTimeLine->totalRevenue;
                $monthlyTimeline->totalProfit  = $totalProfit + $projectMonthlyTimeLine->totalProfit;
                $totalRevenue                  = $totalRevenue + $projectMonthlyTimeLine->totalRevenue;
                $totalProfit                   = $totalProfit + $projectMonthlyTimeLine->totalProfit;

                array_push($monthlyTimeline->monthlyTimelineItems, $projectMonthlyTimeLine);

            }

            array_push($monthlyTimelines, $monthlyTimeline);

        }

        return $monthlyTimelines;

    }

    public function setupTimeline($currentMonthStartDate, $currentMonthEndDate, $projects, $startDate, $endDate)
    {

        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");

        $currentMonthName      = date("M-Y", strtotime($currentMonthStartDate));
        //dd($startDate);
        $timeline = new MonthlyTimeline();

        $timeline->monthName = $currentMonthName;
        $timeline->startDate = $currentMonthStartDate;
        $timeline->endDate   = $currentMonthEndDate;

        $timeline->timelineItems = array();

        // $companyInternalProjects = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);
        $projectsMonthlyTimeLine = $this->setupCostProfitAndRevenue($projects, $currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate);

        return $projectsMonthlyTimeLine;
    }

    // public function getProjectsMonthlyTimeLine($projects, $currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate)
    // {

    //     $projectsMonthlyTimeLine = $this->setupCostProfitAndRevenue($projects, $currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate);

    //     return $projectsMonthlyTimeLine;

    // }

    public function setupCostProfitAndRevenue($projects, $currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate)
    {

        $projectsMonthlyTimeLine = array();
        $currentMonthName        = $this->DateTimeService->getMonthNameAndYear($currentMonthStartDate);

        foreach ($projects as $project) {

            list($projectStartDate, $projectEndDate) = $this->ProjectService->getProjectStartAndEndDate($project);
            

            // list($projectCurrentMonthStartDate, $projectCurrentMonthEndDate) = $this->getProjectCurrentMonthStartAndEndDate($projectStartDate, $projectEndDate, $currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate);

            if (($currentMonthStartDate <= $projectEndDate) && ($projectStartDate <= $currentMonthEndDate)
                && ($currentMonthStartDate <= $currentMonthEndDate) && ($projectStartDate <= $projectEndDate)) {
         

            // if(isset($projectCurrentMonthStartDate) && isset($projectCurrentMonthEndDate))
            // {
              
        // if (($currentMonthStartDate <= $projectEndDate) && ($projectStartDate <= $currentMonthEndDate)
             //   && ($currentMonthStartDate <= $currentMonthEndDate) && ($projectStartDate <= $projectEndDate)) {
                list($monthlyCostSum, $revenue, $profit, $resourcesMonthlyDetails) = $this->projectTimeline($project, $currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate);

                $projectMonthlyTimeLine = new ProjectMonthlyTimeLine();

                if ($projectStartDate >= $currentMonthStartDate) {
                  //  $currentMonthStartDate = $projectStartDate;

                }
                if ($projectEndDate <= $currentMonthEndDate) {
                   //$currentMonthEndDate = $projectEndDate;

                }
                //dd($currentMonthEndDate);
                $projectMonthlyTimeLine->totalCost             = $monthlyCostSum;
                $projectMonthlyTimeLine->monthName             = $currentMonthName;
                $projectMonthlyTimeLine->projectName           = $project->name;
                $projectMonthlyTimeLine->projectId             = $project->id;
                $projectMonthlyTimeLine->projectBudget         = $project->budget;
                $projectMonthlyTimeLine->projectStartDate      = $projectStartDate;
                $projectMonthlyTimeLine->projectEndDate        = $projectEndDate;
                $projectMonthlyTimeLine->currentMonthStartDate = $currentMonthStartDate;
                $projectMonthlyTimeLine->currentMonthEndDate   = $currentMonthEndDate;
                $projectMonthlyTimeLine->totalRevenue          = $revenue;
                $projectMonthlyTimeLine->totalProfit           = $profit;
                $projectMonthlyTimeLine->isActive              = true;
                $projectMonthlyTimeLine->color                 = RandomColorGenerator::one();

                $projectMonthlyTimeLine->resourcesMonthlyDetails = $resourcesMonthlyDetails;

                array_push($projectsMonthlyTimeLine, $projectMonthlyTimeLine);

            }
            // elseif (($projectStartDate <= $endDate) && ($startDate <= $projectEndDate) &&
            //     ($projectStartDate <= $projectEndDate) && ($startDate <= $endDate)) {
            else {
                $projectMonthlyTimeLine = new ProjectMonthlyTimeLine();

                if ($projectStartDate >= $currentMonthStartDate) {
                    //$currentMonthStartDate = $projectStartDate;

                }
                if ($projectEndDate <= $currentMonthEndDate) {
                   // $currentMonthEndDate = $projectEndDate;

                }
                $projectMonthlyTimeLine->totalCost             = null;
                $projectMonthlyTimeLine->monthName             = $currentMonthName;
                $projectMonthlyTimeLine->projectName           = $project->name;
                $projectMonthlyTimeLine->projectId             = $project->id;
                $projectMonthlyTimeLine->projectBudget         = null;
                $projectMonthlyTimeLine->projectStartDate      = $projectStartDate;
                $projectMonthlyTimeLine->projectEndDate        = $projectEndDate;
                $projectMonthlyTimeLine->currentMonthStartDate = $currentMonthStartDate;
                $projectMonthlyTimeLine->currentMonthEndDate   = $currentMonthEndDate;
                $projectMonthlyTimeLine->totalRevenue          = null;
                $projectMonthlyTimeLine->totalProfit           = null;
                $projectMonthlyTimeLine->isActive              = false;
                $projectMonthlyTimeLine->color                 = RandomColorGenerator::one();

                array_push($projectsMonthlyTimeLine, $projectMonthlyTimeLine);
            }

        }

        return $projectsMonthlyTimeLine;

    }

    public function projectTimeline($project, $currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate)
    {

        list($projectCurrentMonthStartDate, $projectCurrentMonthEndDate) =
        $this->getCurrentMonthStartAndEndDates($currentMonthStartDate, $currentMonthEndDate, $projectStartDate, $projectEndDate);
        $monthlyCostSum = 0;
        $resources      = $project->resources;
        if (count($resources) > 0) {
            list($monthlyCostSum, $resourcesMonthlyDetails) = $this->getMonthlyCostProfitAndRevenue($resources, $projectCurrentMonthStartDate, $projectCurrentMonthEndDate);

        }

        $profit        = 0;
        $revenue       = 0;
        $resourcesCost = 0;
        $budget        = $project->budget;
        if ($projectEndDate <= $currentMonthEndDate && $projectEndDate >= $currentMonthStartDate) {

            $budget = round($budget, 2);
            // $resourcesCost = $this->getResourcesTotalCostForProject($project, $resources);
            $resourcesCost = $monthlyCostSum;
            $profit        = $budget - $resourcesCost;
            $profit        = round($profit, 2);
            $revenue       = $budget;

        }

        return array($monthlyCostSum, $revenue, $profit, $resourcesMonthlyDetails);

    }
    /////////////////// to be checked
    public function getResourcesTotalCostForProject($project, $projectResources)
    {

        $resourcesCost = 0;
        $totalCost     = 0;
        $resources     = null;

        list($projectStartDate, $projectEndDate) = $this->ProjectService->getProjectStartAndEndDate($project);

        foreach ($projectResources as $projectResource) {

            list($projectResourceStartDate, $projectResourceEndDate) = $this->ProjectResourceService->getResourceStartAndEndDate($projectResource);

            //if ($projectResourceStartDate >= $projectStartDate && $projectResourceEndDate <= $projectEndDate) {
            if (Max($projectResourceStartDate, $projectStartDate) <= Min($projectResourceEndDate, $projectEndDate)) {

                // if()
                // {

                // }
                $dateDiff = $this->DateTimeService->calculateDifferenceBetweenTwoDates($projectResourceStartDate, $projectResourceEndDate);

                $difference = $dateDiff->days;

                $weeksWorked = ($difference + 1) / 7;

                $cost      = $weeksWorked * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
                $totalCost = $totalCost + $cost;

                // if ($projectTotalCost > 0) {
                //     $resourcesCost =$resourcesCost + round(($totalCost / $projectTotalCost) * 100, 2);
                // }

            }

        }

        return $totalCost;
    }
    public function getProjectCurrentMonthStartAndEndDate($projectStartDate, $projectEndDate, $currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate)
    {

        $projectCurrentMonthStartDate    = null;
        $projectCurrentMonthEndDate      = null;
        $areDatesInLieInSameMonthAndYear = null;

        if (Max($projectStartDate, $startDate) <= Min($projectEndDate, $endDate)) {

            $areDatesInLieInSameMonthAndYear = $this->DateTimeService->areDatesInLieInSameMonthAndYear($projectStartDate, $currentMonthStartDate);

            if ($areDatesInLieInSameMonthAndYear) {
                if ($projectEndDate >= $currentMonthEndDate) {
                    $projectCurrentMonthStartDate = $projectStartDate;
                    $projectCurrentMonthEndDate   = $currentMonthEndDate;
                }

                elseif ($projectEndDate < $currentMonthEndDate) {
                    $projectCurrentMonthStartDate = $projectStartDate;
                    $projectCurrentMonthEndDate   = $projectEndDate;
                }
             

                // $projectCurrentMonthStartDate=$this->DateTimeService->getfirstAndLastDateOfGivenDate($);
                // $projectCurrentMonthEndDate=
            } 
            else {

                if ($projectStartDate <= $currentMonthStartDate && $projectEndDate >= $currentMonthEndDate ) {

                    $projectCurrentMonthStartDate = $currentMonthStartDate;
                    $projectCurrentMonthEndDate = $currentMonthEndDate;
                }
         
                   //dd($currentMonthStartDate);
            }

        }

        // dd($projectCurrentMonthEndDate);
//dd($projectCurrentMonthStartDate);
        return array($projectCurrentMonthStartDate, $projectCurrentMonthEndDate);
    }

    public function getMonthlyCostProfitAndRevenue($resources, $projectCurrentMonthStartDate, $projectCurrentMonthEndDate)
    {
        $resourcesMonthlyDetails = array();

        $monthlyCostSum    = 0;
        $totalCostPerMonth = 0;
        $costPerMonth      = 0;
        foreach ($resources as $resource) {
            //dd($resources);
            list($resourceStartDate, $resourceEndDate) = $this->ProjectResourceService->getResourceStartAndEndDate($resource);

            if (($projectCurrentMonthStartDate <= $resourceEndDate) && ($resourceStartDate <= $projectCurrentMonthEndDate)
                && ($projectCurrentMonthStartDate <= $projectCurrentMonthEndDate) && ($resourceStartDate <= $resourceEndDate)) {
                list($resourceCurrentMonthStartDate, $resourceCurrentMonthEndDate) =
                $this->getCurrentMonthStartAndEndDates($projectCurrentMonthStartDate, $projectCurrentMonthEndDate, $resourceStartDate, $resourceEndDate);

                ///cost////
                $difference = $this->DateTimeService->calculateDifferenceBetweenTwoDates(date("Y-m-d", strtotime($resourceCurrentMonthStartDate)), date("Y-m-d", strtotime($resourceCurrentMonthEndDate)));

                $weeksWorkedInCurrentMonth = ($difference->days + 1) / 7;

                $costPerMonth = $weeksWorkedInCurrentMonth * ($resource->hourlyBillingRate) * ($resource->hoursPerWeek);

                $totalCostPerMonth = $totalCostPerMonth + $costPerMonth;
                $monthlyCostSum    = round($totalCostPerMonth, 2);

                $resourceDetail = new ResourceMonthlyDetail();

                $resourceDetail->resourceId        = $resource->id;
                $resourceDetail->resourceName      = $this->getResourceName($resource);
                $resourceDetail->resourceStartDate = $resourceStartDate;
                $resourceDetail->resourceEndDate   = $resourceEndDate;
                $resourceDetail->resourceCost      = round($costPerMonth, 2);

                array_push($resourcesMonthlyDetails, $resourceDetail);

            }

        }

        return array($monthlyCostSum, $resourcesMonthlyDetails);

    }

    public function getCurrentMonthStartAndEndDates($currentMonthStartDate, $currentMonthEndDate, $startDate, $endDate)
    {
        // dd($endDate);
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

    public function countProjectsIn($monthlyTimelines)
    {
        $projectIds = array();
        foreach ($monthlyTimelines as $monthlyTimeline) {
            foreach ($monthlyTimeline->monthlyTimelineItems as $monthlyTimelineItem) {

                if (!in_array($monthlyTimelineItem->projectId, $projectIds)) {
                    array_push($projectIds, $monthlyTimelineItem->projectId);
                }
            }
        }

        return count($projectIds);
    }

    public function setUpMontlhyTimelines($monthlyTimelines)
    {

        $counter   = 0;
        $timelines = array();

        foreach ($monthlyTimelines as $monthlyTimeline) {

            if ($counter == 0 && count($monthlyTimelines) > 0) {

                $monthlyTimelineArray = array();

                array_push($monthlyTimelineArray, $monthlyTimeline);
                array_push($timelines, $monthlyTimelines);

                $counter++;

            }

        }
        $totalProjects = $this->countProjectsIn($monthlyTimelines);

        for ($i = 0; $i < $totalProjects; $i++) {
            $projects = array();
            foreach ($monthlyTimelines as $monthlyTimeline) {

                if (isset($monthlyTimeline->monthlyTimelineItems[$i])) {
                    $a1 = (array) $monthlyTimeline->monthlyTimelineItems[$i];

                    $a2           = $projects;
                    $inBoth       = array_intersect_assoc($a1, $a2);
                    $onlyInFirst  = array_diff_assoc($a1, $a2);
                    $onlyInSecond = array_diff_assoc($a2, $a1);
                    if ($onlyInFirst) {

                        array_push($projects, $monthlyTimeline->monthlyTimelineItems[$i]);

                    } else {

                        $projects = array();
                        array_push($projects, $monthlyTimeline->monthlyTimelineItems[$i]);

                    }
                }

                // dd($projects);
                //         }

            }
            array_push($timelines, $projects);
        }

        return $timelines;

    }

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

    }
    public function getResourceName($projectResource)
    {
        $resourceName = null;
        if (isset($projectResource->employee_id)) {
            $resourceName = $projectResource->employee->firstName . ' ' . $projectResource->employee->lastName;
        } else {
            $resourceName = $projectResource->title;
        }
        return $resourceName;
    }

    public function getProjectsTimelinesFrom($monthlyTimelines)
    {
        $monthlyTimelines;
        $counter               = 0;
        $projectTimelinesArray = array();
        $test                  = array();

        foreach ($monthlyTimelines as $projectTimelines) {
            if ($counter > 0) {
                $test = array();
                foreach ($projectTimelines as $projectTimeline) {
                    if ($projectTimeline->isActive) {
                        array_push($test, $projectTimeline);
                    }
                }

                array_push($projectTimelinesArray, $test);

            }

            $counter++;

        }
       // dd($projectTimelinesArray);
        return $projectTimelinesArray;
    }

    // public function generateAllProjectsReport($monthlyTimelines)
    // {

    // }
    // public function generateClientProjectsReport($monthlyTimelines)
    // {
    //     dd("here");
    //     $counter   = 0;
    //     $projectId = null;
    //     $test      = array();
    //     foreach ($monthlyTimelines as $projectTimelines) {
    //         if ($counter > 0) {
    //             $projectId = $projectTimelines[0]->projectId;
    //             $project   = ClientProject::find($projectId);
    //             $resources = ProjectResource::where('client_project_id', $projectId)->get();

    //             $resourcesDetails = $this->setupResourcesDetails($resources, $projectTimelines);

    //         }
    //         $counter++;
    //     }

    //     return $monthlyTimelines;

    // }
    // public function generateInternalProjectsReport($monthlyTimelines)
    // {

    //     $counter   = 0;
    //     $projectId = null;
    //     $test      = array();
    //     foreach ($monthlyTimelines as $projectTimelines) {
    //         if ($counter > 0) {
    //             $projectId = $projectTimelines[0]->projectId;
    //             $project   = CompanyProject::find($projectId);
    //             $resources = CompanyProjectResource::where('company_project_id', $projectId)->get();

    //             $resourcesDetails = $this->setupResourcesDetails($resources, $projectTimelines);

    //         }
    //         $counter++;
    //     }

    //     return $monthlyTimelines;

    // }
    ///////////////////////////////////////////////here
    // public function setupResourcesDetails($projectResources, $projectTimelines)
    // {

    //     $counter = 0;
    //     foreach ($projectTimelines as $projectTimeline) {
    //         if ($projectTimeline->isActive) {

    //             $weeksWorkedInCurrentMonth    = 0;
    //             $totalCostPerMonth            = 0;
    //             $costPerMonth                 = 0;
    //             $projectCurrentMonthStartDate = $projectTimeline->currentMonthStartDate;
    //             $projectCurrentMonthEndDate   = $projectTimeline->currentMonthEndDate;
    //             $projectStartDate             = $projectTimeline->projectStartDate;
    //             $projectEndDate               = $projectTimeline->projectEndDate;

    //             $projectTimeline->resourcesMonthlyDetails = array();

    //             foreach ($projectResources as $projectResource) {

    //                 list($projectResourceStartDate, $projectResourceEndDate) =
    //                 $this->ProjectResourceService->getResourceStartAndEndDate($projectResource);

    //                 // $totalMonths = $this->DateTimeService->calculateMonthsBetweenTwoDates($projectCurrentMonthStartDate, $projectCurrentMonthEndDate);

    //                 $resourceTimeLines = array();

    //                 if ($projectResourceStartDate >= $projectCurrentMonthStartDate) {
    //                     $firstDateOfCurrentMonth = $projectResourceStartDate;
    //                 }
    //                 if ($projectResourceEndDate <= $projectCurrentMonthEndDate);
    //                 {
    //                     $lastDateOfCurrentMonth = $projectResourceEndDate;
    //                 }
    //                 // $projectResourceStartDate = date("Y-m-d", strtotime($projectResourceStartDate));
    //                 if ($projectResourceStartDate >= $projectCurrentMonthStartDate && $projectResourceEndDate <= $projectCurrentMonthEndDate) {
    //                     $projectResourceStartInDateTime = new \DateTime($projectResourceStartDate);
    //                 }
    //                 // list($resourceCurrentMonthStartDate, $resourceCurrentMonthEndDate) =
    //                 //                $this->getCurrentMonthStartAndEndDates($projectCurrentMonthStartDate, $projectCurrentMonthEndDate, $resourceStartDate, $resourceEndDate);
    //                 if (Max($projectResourceStartDate, $projectStartDate) <= Min($projectResourceEndDate, $projectEndDate)) {

    //                     if ($projectCurrentMonthStartDate <= $projectCurrentMonthStartDate) {
    //                         if (isset($resourceCurrentMonthStartDate) && isset($resourceCurrentMonthEndDate)) {
    //                             $resourceDetails = $this->setupResourceTimeline($resourceCurrentMonthStartDate, $resourceCurrentMonthEndDate, $projectResourceStartDate, $projectResourceEndDate);
    //                             //dd($resourceDetails);
    //                             echo '<pre>';
    //                             print_r($resourceDetails);
    //                             echo '</pre>';
    //                             $resourceCurrentMonthStartDate = null;
    //                             $resourceCurrentMonthEndDate   = null;

    //                             if (isset($resourceDetails)) {
    //                                 $resourceCurrentMonthStartDate = $resourceDetails->startDate;
    //                                 $resourceCurrentMonthEndDate   = $resourceDetails->endDate;

    //                                 $resourceMonthlyDetail = new ResourceMonthlyDetail();

    //                                 $difference = $resourceDetails->noOfDays;

    //                                 $weeksWorkedInCurrentMonth = ($difference + 1) / 7;

    //                                 $costPerMonth = $weeksWorkedInCurrentMonth * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);

    //                                 //$totalCostPerMonth = $totalCostPerMonth + $costPerMonth;

    //                                 $resourceMonthlyDetail->resourceCost = round($costPerMonth, 2);
    //                                 $resourceMonthlyDetail->resourceId   = $projectResource->id;

    //                                 $resourceMonthlyDetail->resourceName = $this->getResourceName($projectResource);

    //                                 $resourceMonthlyDetail->monthName             = $resourceDetails->currentMonthName;
    //                                 $resourceMonthlyDetail->resourceStartDate     = $resourceDetails->resourceStartDate;
    //                                 $resourceMonthlyDetail->resourceEndDate       = $resourceDetails->resourceEndDate;
    //                                 $resourceMonthlyDetail->currentMonthStartDate = $resourceDetails->startDate;
    //                                 $resourceMonthlyDetail->currentMonthEndDate   = $resourceDetails->endDate;

    //                                 array_push($projectTimeline->resourcesMonthlyDetails, $resourceMonthlyDetail);
    //                                 // /}
    //                                 //  dd($resourceMonthlyDetail);
    //                             }
    //                         }
    //                     }

    //                 }
    //                 // }

    //             }
    //         } else {
    //             $projectTimeline->resourcesMonthlyDetails = array();
    //         }

    //     }
    //    // dd($projectTimelines);
    //     return $projectTimelines;
    // }

    // public function setupResourceTimeline($currentMonthStartDate, $currentMonthEndDate, $projectResourceStartDate, $projectResourceEndDate)
    // {
    //     // dd($currentMonthStartDate);

    //     // if ($projectResourceStartDate >= $currentMonthStartDate) {
    //     //     $currentMonthStartDate = $projectResourceStartDate;

    //     // }
    //     // if ($projectResourceEndDate <= $currentMonthEndDate) {
    //     //     $currentMonthEndDate = $projectResourceEndDate;

    //     // }
    //     $currentMonthName = date("M-Y", strtotime($currentMonthStartDate));

    //     $dateDiff = $this->DateTimeService->calculateDifferenceBetweenTwoDates($currentMonthStartDate, $currentMonthEndDate);

    //     $resourceDetails = new ResourceTimeline();

    //     $resourceDetails->resourceStartDate = $projectResourceStartDate;
    //     $resourceDetails->resourceEndDate   = $projectResourceEndDate;
    //     $resourceDetails->startDate         = $currentMonthStartDate;
    //     $resourceDetails->endDate           = $currentMonthEndDate;
    //     $resourceDetails->noOfDays          = $dateDiff->days + 1;
    //     $resourceDetails->currentMonthName  = $currentMonthName;
    //     // dd($resourceDetails);
    //     return $resourceDetails;
    // }

}
