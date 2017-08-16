<?php

namespace Usman\Timesheet\Services\Interfaces;

interface IEmployeeTimesheetService {

	public function isTimeSheetAlreadyEntered($weekAndYear, $employeeId);
	public function getDatesOfWeek($timesheetDate);
	public function storeTimesheet($request);
	public function updateTimesheet($request, $id);
	public function getTimesheetsOfEmployee($employeeId);
	public function getEmployeeTimesheet($timesheetId);

}
