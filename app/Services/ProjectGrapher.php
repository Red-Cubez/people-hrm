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

        $startDate = strtotime($projectStartDate);
        $nextMonthDate = date("Y-m-d", strtotime("+1 month", $startDate));

         if($projectEndDate>=$nextMonthDate)
         {
             $projectIsInProcessTillNextMonth=true;
             $currentmonthAndYear=date("Y-m",$startDate);

         }
         else{
             $projectIsInProcessTillNextMonth=false;
         }

         if($projectIsInProcessTillNextMonth)
         {

           //  $projectStartDate=date("Y-m", $projectStartDate);
             foreach ($projectResources as $projectResource) {
                 $weeksWorked = $this->calculateWeeksOfResourcesUsedInProject($projectResource);
                 $costPerMonth=$weeksWorked*($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek)*4;
                 $yearMonth=date("Y-m",strtotime($projectResource->actualStartDate));
               //  date(""$projectResource->actualStartDate;
//                 if($projectResource->actualStartDate)
//                 {
//
//                 }
dd($yearMonth);
             }

         }

        $cost = 0;
        $perWeekCost = 0;
        // dd(date("m",strtotime(($projectDetails->actualStartDate))));
        foreach ($projectResources as $projectResource) {

            $weeks = $this->calculateWeeksOfResourcesUsedInProject($projectResource);
            $perWeekCost = ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
            $expectedPerMonthCost = ($perWeekCost) * 4;
            $actualPerMonthCost = $weeks / $expectedPerMonthCost;
            dd($actualPerMonthCost);


        }
        dd($cost);
        return $cost;
    }

    public function calculateWeeksOfResourcesUsedInProject($projectResource)
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
