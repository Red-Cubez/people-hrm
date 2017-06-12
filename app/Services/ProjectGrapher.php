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

        $projectStartMonth = date('m', strtotime($projectStartDate));
        $projectEndMonth = date('m', strtotime($projectEndDate));

        $ts1 = strtotime($projectStartDate);
        $ts2 = strtotime($projectEndDate);

        $projectStartYear = date('Y', $ts1);
        $projectEndYear = date('Y', $ts2);

        $projectStartMonth = date('m', $ts1);
        $projectEndMonth = date('m', $ts2);

        $projectTotalMonths = (($projectEndYear - $projectStartYear) * 12) + ($projectEndMonth - $projectStartMonth);


//////////////// calculating lastvday and date of current month and next month statt date/////////
        $lastDayOfCurrentMonth = date("t", strtotime($projectStartDate));
        $projectLastDayDateOfCurrentMonth = date("Y-m-t", strtotime($projectStartDate));
        // $nextMonthDate = date("Y-m-t", strtotime("+1 month", $projectStartDate));
        $stop_date = new \DateTime($projectLastDayDateOfCurrentMonth);

        $nextMonthStartDate = $stop_date->modify('+1 day');

        // $projectStartDate = $projectDetails->actualStartDate;

        $totalCostPerMonth = 0;
        $projectCurrentMonthDate = $projectDetails->actualStartDate;
        $resourceStartDate = null;
        //dd($projectTotalMonths);
        for ($i = 0; $i < $projectTotalMonths; $i++) {
            foreach ($projectResources as $projectResource) {


                if ($projectResource->actualEndDate == null) {
                    $projectResourceEndDate = $projectResource->expectedEndDate;
                } else {
                    $projectResourceEndDate = $projectResource->actualEndDate;
                }


                if ($resourceStartDate == null) {

                    $resourceStartDate = $projectResource->actualStartDate;
                    $startDate = strtotime($projectResource->actualStartDate);

                    $lastDayOfCurrentMonth = date("t", $startDate);
                    $resourceLastDayDateOfCurrentMonth = date("Y-m-t", $startDate);

                }

                if (($resourceStartDate >= $projectCurrentMonthDate) && ($resourceLastDayDateOfCurrentMonth <= $projectLastDayDateOfCurrentMonth)) {

                    $difference = $this->calculateDiffernceBetweenTwoDate($resourceStartDate, $resourceLastDayDateOfCurrentMonth);
                    $weeksWorkedInCurrentMonth = ($difference->days) / 7;
                    echo $resourceStartDate;
                    echo "------";
                    $costPerMonth = $weeksWorkedInCurrentMonth * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
                    $totalCostPerMonth = $totalCostPerMonth + $costPerMonth;
                    // $yearMonth = date("Y-m", strtotime($projectResource->actualStartDate));


//                    echo $weeksWorkedInCurrentMonth;
//                    echo "-------";
                }


            }
            if ($projectEndDate >= $projectLastDayDateOfNextMonth) {

                $projectCurrentMonthDate = $nextMonthStartDateOfProject;
                if ($resourceStartDate != null) {
                    // $resourceCurrentMonthDate = $projectResource->actualStartDate;

                    $startDate = strtotime($resourceStartDate);

                    $lastDayOfCurrentMonth = date("t", $startDate);
                    $resourceLastDayDateOfCurrentMonth = date("Y-m-t", $startDate);

                    $stop_date = new \DateTime($resourceLastDayDateOfCurrentMonth);

                    $resourceNextMonthStartDate = $stop_date->modify('+1 day');
                    $resourceStartDate = $resourceNextMonthStartDate->format("Y-m-d");

                    echo "not null";
                    echo "next date";
                    echo $nextMonthStartDateOfProject;


                }


            }
            $projectLastDayDate = strtotime($projectLastDayDateOfCurrentMonth);
            $projectLastDayDateOfCurrentMonth = date("Y-m-t", $projectLastDayDate);

            $stop_date = new \DateTime($projectLastDayDateOfCurrentMonth);
            $nextMonthStartDateOfProject = $stop_date->modify('+1 day');
            $nextMonthStartDateOfProject = $nextMonthStartDateOfProject->format("Y-m-d");
            $projectLastDayDateOfNextMonth = date("Y-m-t", strtotime($nextMonthStartDateOfProject));
        }
        //dd($projectCurrentMonthDate);


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
//        foreach ($projectResources as $projectResource) {
//            if ($projectResource->startDate >= $projectStartDate && $projectResource->endDate <= $projectEndDate) {
//                dd("here");
//            }
//            $weeksWorked = $this->calculateWeeksOfResourcesUsedInProject($projectResource);
//            $costPerMonth = $weeksWorked * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek) * 4;
//            $yearMonth = date("Y-m", strtotime($projectResource->actualStartDate));
//            //dd($yearMonth);
//            //  date(""$projectResource->actualStartDate;
////                 if($projectResource->actualStartDate)
////                 {
////
////                 }
////dd($yearMonth);
////            }
////            }
//
//            //  }
//
//            $cost = 0;
//            $perWeekCost = 0;
//            // dd(date("m",strtotime(($projectDetails->actualStartDate))));
//            foreach ($projectResources as $projectResource) {
//
//                $weeks = $this->calculateWeeksOfResourcesUsedInProject($projectResource);
//                $perWeekCost = ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
//                $expectedPerMonthCost = ($perWeekCost) * 4;
//                $actualPerMonthCost = $weeks / $expectedPerMonthCost;
//                //   dd($actualPerMonthCost);
//
//
//            }
//
////    dd($cost);
//            return $cost;
//        }
//
    }

    public function calculateDiffernceBetweenTwoDate($d1, $d2)
    {

        $date1 = date_create($d1);
        $date2 = date_create($d2);
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
