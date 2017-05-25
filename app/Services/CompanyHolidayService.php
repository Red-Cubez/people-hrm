<?php

namespace People\Services;

use People\Models\CompanyHoliday;
use People\Services\Interfaces\ICompanyHolidayService;

class CompanyHolidayService implements ICompanyHolidayService
{

    public function createHoliday($request)
    {

        $companyHoliday = new CompanyHoliday();
        $companyHoliday->name = $request->name;
        $companyHoliday->startDate = $request->startDate;
        $companyHoliday->endDate = $request->endDate;
        $companyHoliday->company_id = $request->companyId;
        $companyHoliday->holidays = $this->countHolidays($request->endDate, $request->startDate);
        $companyHoliday->save();

    }

    /**
     * @param $endDate
     * @param $startDate
     */
    public function countHolidays($endDate, $startDate)
    {
        $date1 = date_create($startDate);
        $date2 = date_create($endDate);
        $diff = date_diff($date1, $date2);
        return $diff->days;
    }

    public function getCompanyHolidays($companyId)
    {
        return CompanyHoliday::orderBy('startDate', 'asc')->where('company_id', $companyId)->get();

    }

    public function updateHoliday($request, $holidayId)
    {
        $holiday = $this->getHolidayDetails($holidayId);
        $holiday->name = $request->name;
        $holiday->startDate = $request->startDate;
        $holiday->endDate = $request->endDate;
        $holiday->holidays = $this->countHolidays($request->endDate, $request->startDate);
        $holiday->save();
    }

    public function getHolidayDetails($holidayId)
    {
        return CompanyHoliday::find($holidayId);
    }

    public function deleteHoliday($holidayId)
    {
        $holiday = $this->getHolidayDetails($holidayId);
        $holiday->delete();
    }
}
