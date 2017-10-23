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

class ResourceCost
{
    public $resourceName;
    public $costPercentage;
}

class ProjectGrapher implements IProjectGrapher
{
    public function calculateProjectTotalCost($projectTimeLines)
    {

        $totalCost = 0;
        foreach ($projectTimeLines as $projectTimeLine) {
            $totalCost = $totalCost + $projectTimeLine->cost;

        }

        return $totalCost;
    }
    public function getStartAndEndDateFrom($details)
    {

        $startDate = null;
        $endDate   = null;

        if ($details->actualEndDate != null) {
            $endDate = $details->actualEndDate;
        } else {
            $endDate = $details->expectedEndDate;
        }

        if ($details->actualStartDate != null) {
            $startDate = $details->actualStartDate;
        } else {
            $startDate = $details->expectedStartDate;
        }

        return array($startDate, $endDate);

    }

    public function getResourcesTotalCostForProject($projectDetails, $projectResources, $projectTotalCost)
    {

        $projectStartDate = null;
        $projectEndDate   = null;

        list($projectStartDate, $projectEndDate) = $this->getStartAndEndDateFrom($projectDetails);

        $resourceDetails = array();
        foreach ($projectResources as $projectResource) {

            $totalCost                = 0;
            $projectResourceStartDate = null;
            $projectResourceEndDate   = null;

            list($projectResourceStartDate, $projectResourceEndDate) = $this->getStartAndEndDateFrom($projectResource);

            if ($projectResourceStartDate >= $projectStartDate && $projectResourceEndDate <= $projectEndDate) {

                $difference = $this->calculateDiffernceBetweenTwoDates($projectResourceStartDate, $projectResourceEndDate);

                $weeksWorked = ($difference->days + 1) / 7;

                $cost      = $weeksWorked * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);
                $totalCost = $totalCost + $cost;

                $resourceCost = new ResourceCost();

                if ($projectResource->employee_id == null) {
                    $resourceCost->resourceName = $projectResource->title;

                } else {
                    $resourceCost->resourceName = $projectResource->resourceName;

                }
                if ($projectTotalCost > 0) {
                    $resourceCost->costPercentage = round(($totalCost / $projectTotalCost) * 100, 2);
                }

                array_push($resourceDetails, $resourceCost);
            }

        }

        return $resourceDetails;
    }

    public function calculateDiffernceBetweenTwoDates($d1, $d2)
    {

        $date1 = date_create($d1);
        $date2 = date_create($d2);
        $diff  = date_diff($date1, $date2);
        return $diff;
    }

    public function setupProjectCost($project, $projectResources, $isCompanyProject)
    {

        list($projectStartDate, $projectEndDate) = $this->getStartAndEndDateFrom($project);
        //  dd("here");
        $totalMonths     = $this->calculateMonthsBetweenTwoDates($projectStartDate, $projectEndDate);
        $projectTimeLine = array();

        $projectStartDate = date("Y-m-d", strtotime($projectStartDate));

        $projectStartInDateTime = new \DateTime($projectStartDate);

        for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {
            $lastDateOfCurrentMonth  = 0;
            $firstDateOfCurrentMonth = 0;
            $currentMonth            = "";

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
        $to          = \Carbon\Carbon::parse($endDate);
        $from        = \Carbon\Carbon::parse($startDate);
        $totalMonths = $to->diffInMonths($from);

        return $totalMonths;

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
        $projectDetails->noOfDays  = $dateDiff->days + 1;
        $projectDetails->cost      = 0;

        return $projectDetails;
    }

    public function calculateResourcesCost($projectResources, $projectTimeLines)
    {

        $counter = 0;
        foreach ($projectTimeLines as $projectTimeLine) {

            $weeksWorkedInCurrentMonth = 0;
            $totalCostPerMonth         = 0;
            $costPerMonth              = 0;
            foreach ($projectResources as $projectResource) {
                list($projectResourceStartDate, $projectResourceEndDate) = $this->getStartAndEndDateFrom($projectResource);

                $totalMonths       = $this->calculateMonthsBetweenTwoDates($projectResourceStartDate, $projectResourceEndDate);
                $resourceTimeLines = array();

                $projectResourceStartDate = date("Y-m-d", strtotime($projectResourceStartDate));

                $projectResourceStartInDateTime = new \DateTime($projectResourceStartDate);

                for ($monthCounter = 0; $monthCounter <= $totalMonths; $monthCounter++) {
                    $lastDateOfCurrentMonth  = 0;
                    $firstDateOfCurrentMonth = 0;
                    $currentMonth            = "";

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
                    //dd($resourceTimeLine);
                    $resourceCurrentMonthStartDate = null;
                    $resourceCurrentMonthEndDate   = null;
                    $projectTimelineStartDate      = null;
                    $projectTimelineEndDate        = null;

                    $projectTimelineStartDate      = $projectTimeLine->startDate;
                    $projectTimelineEndDate        = $projectTimeLine->endDate;
                    $resourceCurrentMonthStartDate = $resourceTimeLine->startDate;
                    $resourceCurrentMonthEndDate   = $resourceTimeLine->endDate;

                    if (Max($resourceCurrentMonthStartDate, $projectTimelineStartDate) <= Min($resourceCurrentMonthEndDate, $projectTimelineEndDate)) {

                        if ($resourceCurrentMonthStartDate <= $projectTimelineStartDate) {
                            $resourceCurrentMonthStartDate = $projectTimelineStartDate;
                            $resourceTimeLine->startDate   = $projectTimelineStartDate;
                        }


                        if ($resourceCurrentMonthEndDate >= $projectTimelineEndDate) {
                            $resourceCurrentMonthEndDate = $projectTimelineEndDate;
                             $resourceTimeLine->endDate   = $projectTimelineEndDate;

                        } 
                        //dd($resourceCurrentMonthEndDate);

                        $difference                 = $this->calculateDiffernceBetweenTwoDates($resourceCurrentMonthStartDate, $resourceCurrentMonthEndDate);
                        $resourceTimeLine->noOfDays = $difference->days + 1;
                        $weeksWorkedInCurrentMonth  = ($difference->days + 1) / 7;

                        $costPerMonth = $weeksWorkedInCurrentMonth * ($projectResource->hourlyBillingRate) * ($projectResource->hoursPerWeek);

                        $totalCostPerMonth     = $totalCostPerMonth + $costPerMonth;
                        $projectTimeLine->cost = round($totalCostPerMonth, 2);

                    }
                }
            }

        }

        return $projectTimeLines;
    }

    public function setupResourceTimeline($currentMonthStartDate, $currentMonthEndDate)
    {

        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName      = date("Y-M", strtotime($currentMonthStartDate));

        $dateDiff = $this->calculateDiffernceBetweenTwoDates($currentMonthStartDate, $currentMonthEndDate);

        $resourceDetails            = new ResourceTimeline();
        $resourceDetails->startDate = $currentMonthStartDate;
        $resourceDetails->endDate   = $currentMonthEndDate;
        $resourceDetails->noOfDays  = $dateDiff->days + 1;

        return $resourceDetails;
    }

    public function calculateWeeksOfResourcesUsedInProject($projectResource)
    {
        $date1 = date_create($projectResource->actualStartDate);
        $date2 = date_create($projectResource->actualEndDate);
        $diff  = date_diff($date1, $date2);

        $days  = $diff->days + 1;
        $weeks = ($days / 7);
        return $weeks;

    }

}
