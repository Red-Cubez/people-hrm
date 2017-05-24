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
        $companyHoliday->holidays = $this->countHolidays($request->endDate,$request->startDate);
        $companyHoliday->save();

    }

    public function getCompanyHolidays($companyId)
    {
        return CompanyHoliday::orderBy('startDate','asc')->where('company_id',$companyId)->get();

    }

    /**
     * @param $endDate
     * @param $startDate
     */
    public function countHolidays($endDate, $startDate)
    {

//        $count =  date_diff($endDate, $startDate);
//        dd($count);
     return date("d",strtotime($endDate)) - date("d",strtotime($startDate));
//        dd($count);
    }

    public function getHolidayDetails($holidayId)
    {
        return CompanyHoliday::find($holidayId);
    }

    public function updateHoliday($request,$holidayId)
    {
        $holiday=$this->getHolidayDetails($holidayId);
        $holiday->name=$request->name;
        $holiday->startDate=$request->startDate;
        $holiday->endDate=$request->endDate;
        $holiday->holidays = $this->countHolidays($request->endDate,$request->startDate);
        $holiday->save();
    }
    public function deleteHoliday($holidayId)
    {
        $holiday=$this->getHolidayDetails($holidayId);
        $holiday->delete();
    }
}
