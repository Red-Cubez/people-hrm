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

    public function validateStartAndEndDates($startDate, $endDate)
    {
        if ($endDate <= $startDate) {
            return false;
        } else {
            return true;
        }

    }

    public function getMonthNameAndYear($currentMonthStartDate)
    {

        $currentMonthStartDate = new \DateTime($currentMonthStartDate);
        $currentMonthStartDate = $currentMonthStartDate->format("Y-m-d");
        $currentMonthName      = date("M-Y", strtotime($currentMonthStartDate));

        return $currentMonthName;
    }

    public function calculateMonthsBetweenTwoDates($startDate, $endDate)
    {
        $to             = \Carbon\Carbon::parse($endDate);
        $from           = \Carbon\Carbon::parse($startDate);
        $totalMonths = $to->diffInMonths($from);

        // if($totalMonths==0)
        // {
            //$totalMonths=$totalMonths+1;
        //}

        // $timeSpan1 = strtotime($startDate);
        // $timeSpan2 = strtotime($endDate);
        // $startYear = date('Y', $timeSpan1);
        // $endYear   = date('Y', $timeSpan2);

        // $startMonth = date('m', $timeSpan1);
        // $endMonth   = date('m', $timeSpan2);

        // $totalMonths = (($endYear - $startYear) * 12) + ($endMonth - $startMonth);
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

        return array($startDate, $endDate);

    }

//     public function getfirstAndLastDateFromGivenMonthAndYear($request)
    //     {
    //         $startDate           = strtotime($request->startDate);
    //         $startDateInDateTime = new \DateTime(date("Y-m-01", $startDate));
    //         $startDate           = $startDateInDateTime->format("Y-m-d");

//         $endDate           = strtotime($request->endDate);
    //         $endDateInDateTime = new \DateTime(date("Y-m-t", $endDate));
    //         $endDate           = $endDateInDateTime->format("Y-m-d");

//         $request->request->startDate=$startDate;
    //         $request->request->endDate=$endDate;

//         $startAndEndDate=array(['startDate'=>$startDate,'endDate'=>$endDate]);
    // //dd($startAndEndDate);
    //         return $startAndEndDate;
    //     }

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
