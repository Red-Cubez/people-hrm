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

    public function getInternalProjectTimelines($companyProject)
    {
        list($currentProjectResources) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProject->id);

        //$companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

        $projectTimelines = $this->ProjectGrapher->setupProjectCost($companyProject, $currentProjectResources, true);
        if (count($projectTimelines) > 0) {

            $projectTimelines[0]->project = $companyProject;
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
           
        $budget  = 0;
        foreach ($projectsTimelines as $projectTimelines) {

            if (count($projectTimelines) > 0) {
                $budget = $budget + $projectTimelines[0]->project->budget;
            }
        }

        $revenue = 0;
       
        foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
            $startAndEndDateTimeline->revenue = 0;
            //$flag=0;
            foreach ($projectsTimelines as $projectTimelines) {

                foreach ($projectTimelines as $projectTimeline) {

                    if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {
                        if (isset($projectTimeline->project)) {

                        //  if ($sumOfCost != $startAndEndDateTimeline->cost) {
                        //$profit = $startAndEndDateTimeline->profit;
                        ///
                            $revenue = $startAndEndDateTimeline->revenue + $projectTimeline->project->budget;

                        $startAndEndDateTimeline->revenue = $budget;
                        }

                        $startAndEndDateTimeline->revenue = $revenue;
                    }
                    else
                    {
                        
                        $startAndEndDateTimeline->revenue = $revenue;
                    }
                }
                //  }

                // } else {
                //   if ($profit1 > 0) {
            }

                //  }
        }

                //      }
//dd($startAndEndDateTimelines);
        ////////////////////////////////////////////////////////////////////
        // $profit  = 0;
        // $profit1 = 0;
        // $budget  = 0;
        // foreach ($projectsTimelines as $projectTimelines) {

                // }
          //  }
            // dd($startAndEndDateTimeline);
        //     if (count($projectTimelines) > 0) {
        //         $budget = $budget + $projectTimelines[0]->project->budget;
        //     }
        // }

            // foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
            //     $profitSum = $profitSum + $profit;
            //     $profit    = $startAndEndDateTimeline->profit;
            //     if ($startAndEndDateTimeline->profit == $profit) {
            //         $startAndEndDateTimeline->netTotal = $profitSum;
        // foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
        //     $startAndEndDateTimeline->netTotal = 0;
        //     foreach ($projectsTimelines as $projectTimelines) {

            //     }
        //         foreach ($projectTimelines as $projectTimeline) {
        //             if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {

            // dd($startAndEndDateTimelines);
        //}
        //                 $startAndEndDateTimeline->netTotal = $budget;
        //             }
        //         }

        //     }

        // }
        return $startAndEndDateTimelines;

    }


//         $revenue = 0;

//         foreach ($startAndEndDateTimelines as $startAndEndDateTimeline) {
//             $startAndEndDateTimeline->revenue = 0;
//             //$flag=0;
//             foreach ($projectsTimelines as $projectTimelines) {

//                 foreach ($projectTimelines as $projectTimeline) {

//                     if ($startAndEndDateTimeline->monthName == $projectTimeline->monthName) {
//                         if (count($projectTimelines) > 0) {

//                             $revenue =$projectTimelines[0]->project->budget;
  

//                         }
//                         else
//                         {
//                             $revenue=$startAndEndDateTimeline->revenue;
//                         }

//                             $startAndEndDateTimeline->revenue=$revenue;
                        
//                         //$startAndEndDateTimeline->revenue = $revenue;

//                     }
//                     // else {
  
//                     //     $startAndEndDateTimeline->revenue = $startAndEndDateTimeline->revenue;
//                     // }

//                 }

//             }

//         }
// //dd("ER");
//         return $startAndEndDateTimelines;

//     }

}
