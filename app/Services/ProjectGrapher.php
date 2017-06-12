<?php

namespace People\Services;

use People\Services\Interfaces\IProjectGrapher;

class ProjectGrapher implements IProjectGrapher
{
    public function setupProjectCost($projectDetails, $projectResources, $isCompanyProject)
    {
        $resourcesCost = $this->calculateResourcesCost($projectResources, $projectDetails);

        //   dd($fixedResourcesCost + $employeeResourcesCost);
    }

    public function calculateResourcesCost($projectResources, $projectDetails)
    {

        $projectStartDate = $projectDetails->actualStartDate;

        if ($projectDetails->actualEndDate != null) {
            $projectEndDate = $projectDetails->actualEndDate;
        } else {
            $projectEndDate = $projectDetails->expectedEndDate;
        }
        $currentMonthDate = $projectStartDate;

        $projectStartDate = strtotime($projectStartDate);
//////////////// calculating lastvday and date of current month and next month statt date/////////
        $lastDayOfCurrentMonth = date("t", $projectStartDate);
        $projectLastDayDateOfCurrentMonth = date("Y-m-t", $projectStartDate);
        // $nextMonthDate = date("Y-m-t", strtotime("+1 month", $projectStartDate));
        $stop_date = new \DateTime($projectLastDayDateOfCurrentMonth);

        $nextMonthStartDate = $stop_date->modify('+1 day');

        $projectStartDate = $projectDetails->actualStartDate;

        $TotalCostPerMonth = 0;
        foreach ($projectResources as $projectResource) {

            if ($projectResource->actualEndDate == null) {
                $projectResourceEndDate = $projectResource->expectedEndDate;
            } else {
                $projectResourceEndDate = $projectResource->actualEndDate;
            }
            $resourceStartDate = strtotime($projectResource->actualStartDate);

            $lastDayOfCurrentMonth = date("t", $resourceStartDate);
            $resourceLastDayDateOfCurrentMonth = date("Y-m-t", $resourceStartDate);

            $stop_date = new \DateTime($resourceLastDayDateOfCurrentMonth);

            $resourceNextMonthStartDate = $stop_date->modify('+1 day');

/////////////////////For differnce of 1 or more than 1 month////
            if (($projectResource->actualStartDate >= $projectStartDate) && ($resourceLastDayDateOfCurrentMonth <= $projectLastDayDateOfCurrentMonth)) {
                
                $difference = $this->calculateDiffernceBetweenTwoDate($projectResource->actualStartDate, $resourceLastDayDateOfCurrentMonth);
                $weeksWorkedInCurrentMonth = ($difference->days) / 7;

                $costPerMonth = $weeksWorkedInCurrentMonth * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
                $TotalCostPerMonth = $TotalCostPerMonth + $costPerMonth;
                $yearMonth = date("Y-m", strtotime($projectResource->actualStartDate));
            }

        }
        dd($TotalCostPerMonth);


//        if ($projectEndDate >= $nextMonthDate) {
//            $projectIsInProcessTillNextMonth = true;
//            $currentmonthAndYear = date("Y-m", $startDate);
//
//        } else {
//            $projectIsInProcessTillNextMonth = false;
//        }
//       // dd($projectEndDate);
//        $date = new \DateTime($projectStartDate);
//        $date->modify('last day of this month');
//      //  dd( $date->format('d'));
//        if ($projectIsInProcessTillNextMonth) {
//
//            //  $projectStartDate=date("Y-m", $projectStartDate);
//       //     if($projectResource->actualStartDate)
//      //      {
        foreach ($projectResources as $projectResource) {
            if ($projectResource->startDate >= $projectStartDate && $projectResource->endDate <= $projectEndDate) {
                dd("here");
            }
            $weeksWorked = $this->calculateWeeksOfResourcesUsedInProject($projectResource);
            $costPerMonth = $weeksWorked * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek) * 4;
            $yearMonth = date("Y-m", strtotime($projectResource->actualStartDate));
            //dd($yearMonth);
            //  date(""$projectResource->actualStartDate;
//                 if($projectResource->actualStartDate)
//                 {
//
//                 }
//dd($yearMonth);
//            }
//            }

            //  }

            $cost = 0;
            $perWeekCost = 0;
            // dd(date("m",strtotime(($projectDetails->actualStartDate))));
            foreach ($projectResources as $projectResource) {

                $weeks = $this->calculateWeeksOfResourcesUsedInProject($projectResource);
                $perWeekCost = ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
                $expectedPerMonthCost = ($perWeekCost) * 4;
                $actualPerMonthCost = $weeks / $expectedPerMonthCost;
                //   dd($actualPerMonthCost);


            }

//    dd($cost);
            return $cost;
        }

    }

    public function calculateDiffernceBetweenTwoDate($date1, $date2)
    {
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        $diff = date_diff($date1, $date2);
        return $diff;
    }

    public
    function calculateWeeksOfResourcesUsedInProject($projectResource)
    {
        $date1 = date_create($projectResource->actualStartDate);
        $date2 = date_create($projectResource->actualEndDate);
        $diff = date_diff($date1, $date2);

        $days = $diff->days;
        $weeks = ($days / 5);
        //$dayRemainder = $days % 7;
        return $weeks;

    }


}
