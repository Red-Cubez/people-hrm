<?php

namespace People\Services\Interfaces;

interface IDateTimeService
{
    public function getFirstAndLastDateCurrentOfMonth($monthCounter, $totalMonths, $startDateInDateTime, $endDate);

    public function calculateMonthsBetweenTwoDates($startDate, $endDate);

    public function getfirstAndLastDateOfGivenDate($startDate, $endDate);

    public function calculateDifferenceBetweenTwoDates($d1, $d2);

    public function getMonthNameAndYear($currentMonthStartDate);

    public function validateStartAndEndDates($startDate, $endDate);

    // public function getfirstAndLastDateFromGivenMonthAndYear($request);

}
