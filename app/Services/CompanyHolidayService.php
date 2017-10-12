<?php

namespace People\Services;

use People\Models\CompanyHoliday;
use People\Services\Interfaces\ICompanyHolidayService;

class CompanyHolidayService implements ICompanyHolidayService {

	public function createHoliday($request) {

		$companyHoliday = new CompanyHoliday();
		$companyHoliday->name = $request->name;
		$companyHoliday->startDate = $request->startDate;

		if (!isset($request->endDate)) {
			$companyHoliday->endDate = $request->startDate;
		} else {
			$companyHoliday->endDate = $request->endDate;
		}

		$companyHoliday->company_id = $request->companyId;
		$companyHoliday->holidays = $this->countHolidays($companyHoliday->endDate, $companyHoliday->startDate);

		$companyHoliday->save();
		return $companyHoliday;

	}

	/**
	 * @param $endDate
	 * @param $startDate
	 */
	public function countHolidays($endDate, $startDate) {
		$date1 = date_create($startDate);
		$date2 = date_create($endDate);
		$diff = date_diff($date1, $date2);
		return $diff->days+1;
	}

	public function getCompanyHolidays($companyId) {
		return CompanyHoliday::orderBy('startDate', 'asc')->where('company_id', $companyId)->get();

	}

	public function updateHoliday($request, $holidayId) {
		$holiday = $this->getHolidayDetails($holidayId);
		$holiday->name = $request->name;
		$holiday->startDate = $request->startDate;

		$holiday->endDate = $request->endDate;
		if (!isset($request->endDate)) {
			$holiday->endDate = $request->startDate;
		}

		$holiday->holidays = $this->countHolidays($request->endDate, $request->startDate);
		$holiday->save();
		return $holiday;
	}

	public function getHolidayDetails($holidayId) {
		return CompanyHoliday::find($holidayId);
	}

	public function deleteHoliday($holidayId) {
		$holiday = $this->getHolidayDetails($holidayId);
		$holiday->delete();
	}
}
