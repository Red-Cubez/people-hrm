<?php

namespace People\Services;

use People\Services\Interfaces\IProjectGrapher;

class ProjectTimeline
{
    public $monthName;
    public $startDate;
    public $endDate;
    public $noOfDays;
    public $cost;
}

class ResourceTimeline
{
    public $startDate;
    public $endDate;
    public $noOfDays;

}


class ProjectGrapher implements IProjectGrapher
{

    public function setupProjectCost($project, $projectResources, $isCompanyProject)
    {
        if ($project->actualEndDate != null) {
            $projectEndDate = $project->actualEndDate;
        } else {
            $projectEndDate = $project->expectedEndDate;
        }

        $totalMonths = $this->calculateMonthsBetweenTwoDates($project->actualStartDate, $projectEndDate);
        $projectTimeLine = array();

        $projectStartDate = date("Y-m-d", strtotime($project->actualStartDate));

        $projectStartInDateTime = new \DateTime($projectStartDate);

        for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {
            $lastDateOfCurrentMonth = 0;
            $firstDateOfCurrentMonth = 0;
            $currentMonth = "";

            if ($monthCounter == 0) {
                $firstDateOfCurrentMonth = $projectStartInDateTime;

            } else {
                $currentMonth = strtotime($projectStartInDateTime->modify('+1 month')->format("Y-m-d"));

                $firstDateOfCurrentMonth = new \DateTime(date("Y-m-01", $currentMonth));
            }
            if ($monthCounter == $totalMonths) {
                $lastDateOfCurrentMonth = $projectEndDate;

            } else {

                $lastDateOfCurrentMonth = $firstDateOfCurrentMonth->format("Y-m-t");

            }

            $projectDetails = $this->setupProjectTimeline($firstDateOfCurrentMonth, $lastDateOfCurrentMonth);

            array_push($projectTimeLine, $projectDetails);
        }
        $projectTimeLines = $this->calculateResourcesCost($projectResources, $projectTimeLine);
        return $projectTimeLines;
    }

    public function calculateMonthsBetweenTwoDates($startDate, $endDate)
    {
        $timeSpan1 = strtotime($startDate);
        $timeSpan2 = strtotime($endDate);
        $startYear = date('Y', $timeSpan1);
        $endYear = date('Y', $timeSpan2);

        $startMonth = date('m', $timeSpan1);
        $endMonth = date('m', $timeSpan2);

        $totalMonths = (($endYear - $startYear) * 12) + ($endMonth - $startMonth);
        return $totalMonths;
    }

    public function setupProjectTimeline($currentMonthStartDate, $currentMonthEndDate)
    {

        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName = date("Y-M", strtotime($currentMonthStartDate));

        $dateDiff = $this->calculateDiffernceBetweenTwoDates($currentMonthStartDate, $currentMonthEndDate);

        $projectDetails = new ProjectTimeline();
        $projectDetails->monthName = $currentMonthName;
        $projectDetails->startDate = $currentMonthStartDate;
        $projectDetails->endDate = $currentMonthEndDate;
        $projectDetails->noOfDays = $dateDiff->days;
        $projectDetails->cost = 0;

        return $projectDetails;
    }

    public function calculateDiffernceBetweenTwoDates($d1, $d2)
    {

        $date1 = date_create($d1);
        $date2 = date_create($d2);
        $diff = date_diff($date1, $date2);
        return $diff;
    }

    public function calculateResourcesCost($projectResources, $projectTimeLines)
    {
        $counter = 0;
        foreach ($projectTimeLines as $projectTimeLine) {

            $weeksWorkedInCurrentMonth = 0;
            $totalCostPerMonth = 0;
            $costPerMonth = 0;
            foreach ($projectResources as $projectResource) {

                if ($projectResource->actualEndDate == null) {
                    $projectResourceEndDate = $projectResource->expectedEndDate;
                } else {
                    $projectResourceEndDate = $projectResource->actualEndDate;

                }
                $totalMonths = $this->calculateMonthsBetweenTwoDates($projectResource->actualStartDate, $projectResourceEndDate);
                $resourceTimeLines = array();

                $projectResourceStartDate = date("Y-m-d", strtotime($projectResource->actualStartDate));

                $projectResourceStartInDateTime = new \DateTime($projectResourceStartDate);

                for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {
                    $lastDateOfCurrentMonth = 0;
                    $firstDateOfCurrentMonth = 0;
                    $currentMonth = "";

                    if ($monthCounter == 0) {
                        $firstDateOfCurrentMonth = $projectResourceStartInDateTime;

                    } else {
                        $currentMonth = strtotime($projectResourceStartInDateTime->modify('+1 month')->format("Y-m-d"));

                        $firstDateOfCurrentMonth = new \DateTime(date("Y-m-01", $currentMonth));
                    }
                    if ($monthCounter == $totalMonths) {
                        $lastDateOfCurrentMonth = $projectResourceEndDate;

                    } else {
                        $lastDateOfCurrentMonth = $firstDateOfCurrentMonth->format("Y-m-t");
                    }

                    $resourceDetails = $this->setupResourceTimeline($firstDateOfCurrentMonth, $lastDateOfCurrentMonth);

                    array_push($resourceTimeLines, $resourceDetails);
                }

                foreach ($resourceTimeLines as $resourceTimeLine) {

                    if ($resourceTimeLine->startDate >= $projectTimeLine->startDate && $resourceTimeLine->startDate <= $projectTimeLine->startDate) {
                        $difference = $this->calculateDiffernceBetweenTwoDates(date("Y-m-d", strtotime($resourceTimeLine->startDate)), date("Y-m-d", strtotime($resourceTimeLine->endDate)));

                        $weeksWorkedInCurrentMonth = ($difference->days) / 7;

                        $costPerMonth = $weeksWorkedInCurrentMonth * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
                        $totalCostPerMonth = $totalCostPerMonth + $costPerMonth;
                        $projectTimeLine->cost=$totalCostPerMonth;
                    }
                }

            }
        }
        return $projectTimeLines;
    }

    public function setupResourceTimeline($currentMonthStartDate, $currentMonthEndDate)
    {

        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName = date("Y-M", strtotime($currentMonthStartDate));

        $dateDiff = $this->calculateDiffernceBetweenTwoDates($currentMonthStartDate, $currentMonthEndDate);

        $resourceDetails = new ResourceTimeline();
        $resourceDetails->startDate = $currentMonthStartDate;
        $resourceDetails->endDate = $currentMonthEndDate;
        $resourceDetails->noOfDays = $dateDiff->days;

        return $resourceDetails;
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
