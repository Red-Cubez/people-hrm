<?php

namespace People\Services\Interfaces;

interface ICompanyHolidayService
{

    public function createHoliday($request);

    public function getCompanyHolidays($companyId);

    public function getHolidayDetails($holidayId);
    public function updateHoliday($request,$holidayId);
    public function deleteHoliday($holidayId);

}
