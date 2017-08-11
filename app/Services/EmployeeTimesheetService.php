<?php
namespace People\Services;

use People\Models\EmployeeTimesheet;
use People\services\Interfaces\IEmployeeTimesheetService;

class EmployeeTimesheetService implements IEmployeeTimesheetService {

	public function isTimeSheetAlreadyEntered($weekAndYear, $employeeId) {
		$isAlreadyEntered = false;
		$employeeTimeSheet = EmployeeTimesheet::where('weekNoAndYear', $weekAndYear)->where('employee_id', $employeeId)->get();
		if (count($employeeTimeSheet) > 0) {
			$isAlreadyEntered = true;
		}
		return $isAlreadyEntered;
	}

	public function getDatesOfWeek($timesheetDate) {

		$week = array();
		$week['monday'] = date('d-m-Y', $timesheetDate);
		$monday = $week['monday'];

		$date = new \DateTime($monday);
		$week['tuesday'] = $date->modify('+1 day')->format('d-m-Y');
		$week['wednesday'] = $date->modify('+1 day')->format('d-m-Y');
		$week['thursday'] = $date->modify('+1 day')->format('d-m-Y');
		$week['friday'] = $date->modify('+1 day')->format('d-m-Y');
		$week['saturday'] = $date->modify('+1 day')->format('d-m-Y');
		$week['sunday'] = $date->modify('+1 day')->format('d-m-Y');

		return $week;
	}
	public function storeTimesheet($request) {
		$timesheet = new EmployeeTimesheet();

		$timesheet->employee_id = $request->employeeId;
		$timesheet->weekNoAndYear = $request->timesheetDate;

		$billableDays = $timesheet->billableWeeklyTimeSheet;
		$billableDays['monday'] = $request->mondayBillable;
		$billableDays['tuesday'] = $request->tuesdayBillable;
		$billableDays['wednesday'] = $request->wednesdayBillable;
		$billableDays['thursday'] = $request->thursdayBillable;
		$billableDays['friday'] = $request->fridayBillable;
		$billableDays['saturday'] = $request->saturdayBillable;
		$billableDays['sunday'] = $request->sundayBillable;
		$timesheet->billableWeeklyTimeSheet = $billableDays;

		$nonBillableDays = $timesheet->billableWeeklyTimeSheet;
		$nonBillableDays['monday'] = $request->mondayNonBillable;
		$nonBillableDays['tuesday'] = $request->tuesdayNonBillable;
		$nonBillableDays['wednesday'] = $request->wednesdayNonBillable;
		$nonBillableDays['thursday'] = $request->thursdayNonBillable;
		$nonBillableDays['friday'] = $request->fridayNonBillable;
		$nonBillableDays['saturday'] = $request->saturdayNonBillable;
		$nonBillableDays['sunday'] = $request->sundayNonBillable;
		$timesheet->nonBillableWeeklyTimeSheet = $nonBillableDays;

		$timesheet->isApproved = 0;
		$timesheet->save();
	}
	public function validateTimesheet($request) {
		$errors = false;
		if ($request->timesheetDate == null) {
			$errors = true;
		}

		if ($request->mondayBillable == null) {
			$errors = true;
		}

		if ($request->tuesdayBillable == null) {
			$errors = true;
		}

		if ($request->wednesdayBillable == null) {
			$errors = true;
		}

		if ($request->thursdayBillable == null) {
			$errors = true;
		}

		if ($request->fridayBillable == null) {
			$errors = true;
		}

		if ($request->saturdayBillable == null) {
			$errors = true;
		}

		if ($request->sundayBillable == null) {
			$errors = true;
		}

		return $errors;
	}
	public function getTimesheetsOfEmployee($employeeId) {
		$timesheets = EmployeeTimesheet::orderBy('created_at')->where('employee_id', $employeeId)->get();
		return $timesheets;
	}
}
