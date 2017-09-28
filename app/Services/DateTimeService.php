<?php

namespace People\Services;

use People\Services\Interfaces\IDateTimeService;

class DateTimeService implements IDateTimeService
{
    public function getStartAndEndDateTimelines($startDate, $endDate, $companyId)
    {

        $totalMonths = $this->calculateMonthsBetweenTwoDates($startDate, $endDate);
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

            $timelineDetails = $this->setupTimeline($firstDateOfCurrentMonth, $lastDateOfCurrentMonth);

            array_push($timeLine, $timelineDetails);

        }

        return $timeLine;
    }

    public function setupTimeline($currentMonthStartDate, $currentMonthEndDate)
    {

        // $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        // $currentMonthName      = date("M-Y", strtotime($currentMonthStartDate));

        // $dateDiff = $this->calculateDiffernceBetweenTwoDates($currentMonthStartDate, $currentMonthEndDate);

        // $projectDetails = new ProjectTimeline();

        // $projectDetails->monthName = $currentMonthName;
        // $projectDetails->startDate = $currentMonthStartDate;
        // $projectDetails->endDate   = $currentMonthEndDate;

        // $projectDetails->cost      = 0;

        // return $projectDetails;
    }

    public function getMonthNameAndYear($currentMonthStartDate)
    {   

        $currentMonthStartDate=new \DateTime($currentMonthStartDate);
        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName      = date("Y-M", strtotime($currentMonthStartDate));

        return $currentMonthName;
    }

    public function calculateMonthsBetweenTwoDates($startDate, $endDate)
    {
        $timeSpan1 = strtotime($startDate);
        $timeSpan2 = strtotime($endDate);
        $startYear = date('Y', $timeSpan1);
        $endYear   = date('Y', $timeSpan2);

        $startMonth = date('m', $timeSpan1);
        $endMonth   = date('m', $timeSpan2);

        $totalMonths = (($endYear - $startYear) * 12) + ($endMonth - $startMonth);
        return $totalMonths;
    }

    public function getfirstAndLastDateOfGivenDate($startDate, $endDate)
    {
        $startDate           = strtotime($startDate);
        $startDateInDateTime = new \DateTime(date("Y-m-01", $startDate));
        $startDate           = $startDateInDateTime->format("Y-m-d");

        $endDate           = strtotime($endDate);
        $endDateInDateTime = new \DateTime(date("Y-m-t", $endDate));
        $endDate           = $endDateInDateTime->format("Y-m-d");

        return array($startDate,$endDate);

    }

    public function getFirstAndLastDateCurrentOfMonth($monthCounter, $totalMonths, $startDateInDateTime, $endDate)
    {
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
        return array($firstDateOfCurrentMonth, $lastDateOfCurrentMonth);
    }

     public function calculateDifferenceBetweenTwoDates($d1, $d2)
    {

        $date1 = date_create($d1);
        $date2 = date_create($d2);
        $diff  = date_diff($date1, $date2);
        return $diff;
    }

}
