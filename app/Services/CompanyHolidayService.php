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
        $companyHoliday->save();

    }

    public function getCompanyHolidays($companyId)
    {
        return CompanyHoliday::orderBy('startDate','asc')->where('company_id',$companyId)->get();

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
        $holiday->save();
    }
    public function deleteHoliday($holidayId)
    {
        $holiday=$this->getHolidayDetails($holidayId);
        $holiday->delete();
    }
}
