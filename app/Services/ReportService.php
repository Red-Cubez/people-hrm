<?php

namespace People\Services;

use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IProjectGrapher;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IReportService;

class ReportService implements IReportService
{
    public $ProjectGrapher;
    public $CompanyProjectService;
    public $CompanyProjectResourceService;
    public $ClientProjectService;
    public $ProjectService;
    public $ProjectResourceService;

    public function __construct(IProjectGrapher $projectGrapher, ICompanyProjectService $companyProjectService, ICompanyProjectResourceService $companyProjectResourceService,
        IClientProjectService $clientProjectService, IProjectService $projectService, IProjectResourceService $projectResourceService) {

        $this->ProjectGrapher                = $projectGrapher;
        $this->CompanyProjectService         = $companyProjectService;
        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ClientProjectService          = $clientProjectService;
        $this->ProjectService                = $projectService;
        $this->ProjectResourceService        = $projectResourceService;

    }

    public function getClientProjectsTimeLines($companyId, $startDate, $endDate)
    {

        $clientProjectsTimeLines = array();
        $clients                 = $this->ClientProjectService->getAllClientsOfCompanyWithProjects($companyId);
        foreach ($clients as $client) {

            foreach ($client->projects as $companyClientProject) {

                list($projectStartDate, $projectEndDate) = $this->ClientProjectService->getProjectStartAndEndDate($companyClientProject);

                if (($startDate <= $projectEndDate) && ($projectStartDate <= $endDate)
                    && ($startDate <= $endDate) && ($projectStartDate <= $projectEndDate)) {

                    $projectsTimeLines = $this->getClientProjectTimelines($companyClientProject->id, $startDate, $endDate);

                    array_push($clientProjectsTimeLines, $projectsTimeLines);
                }
            }

        }

        return $clientProjectsTimeLines;

    }

    public function getClientProjectTimelines($clientProjectId)
    {
        list($currentProjectResources) = $this->ProjectResourceService->showClientProjectResources($clientProjectId);

        $clientProject = $this->ClientProjectService->viewClientProject($clientProjectId);

        $projectTimelines = $this->ProjectGrapher->setupProjectCost($clientProject, $currentProjectResources, false);
         if(count($projectTimelines)>0)
        {

          $projectTimelines[0]->projectName=$clientProject->name;
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

                $projectsTimeLines = $this->getInternalProjectTimelines($companyInternalProject->id, $startDate, $endDate);

                array_push($companyInternalProjectsTimeLines, $projectsTimeLines);
            }
        }

        return $companyInternalProjectsTimeLines;
    }

    public function getInternalProjectTimelines($companyProjectId)
    {
        list($currentProjectResources) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);

        $companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

        $projectTimelines = $this->ProjectGrapher->setupProjectCost($companyProject, $currentProjectResources, true);
        if(count($projectTimelines)>0)
        {

          $projectTimelines[0]->projectName=$companyProject->name;
        }
        return $projectTimelines;
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
    public function calculateMonthlyCost($projectsTimelines, $months)
    {
        $monthlyCostArray = array();
        $sumOfCost        = 0;
        foreach ($months as $monthName) {
            foreach ($projectsTimelines as $projectTimelines) {
                foreach ($projectTimelines as $projectTimeline) {

                    if ($monthName == $projectTimeline->monthName) {
                        $sumOfCost = $sumOfCost + $projectTimeline->cost;
                        array_push($monthlyCostArray, $sumOfCost);
                    }

                }
            }
        }

        return $monthlyCostArray;
    }

    public function mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines,$projectBudget)
    {
        $sumOfCost = 0;
       // $profit    = $projectBudget;
        foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
            {
                foreach ($projectsTimelines as $projectTimelines) {

                    foreach ($projectTimelines as $projectTimeline) {
                        if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {

                            $sumOfCost                       = $sumOfCost + $projectTimeline->cost;
                            $startAndEndDateTimeline->cost   = $sumOfCost;
                            //$startAndEndDateTimeline->profit   = $sumOfCost;
                           // $profit                          = $profit - $sumOfCost + $projectTimeline->cost;
                            //$startAndEndDateTimeline->profit = $profit;
                        } else {
                            $startAndEndDateTimeline->cost   = $sumOfCost;
                           // $startAndEndDateTimeline->profit = $profit;
                        }
                    }
                }
            }

        }
        
        return $startAndEndDateTimelines;
    }
}
