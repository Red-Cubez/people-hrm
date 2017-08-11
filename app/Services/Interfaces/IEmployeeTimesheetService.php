<?php

namespace People\Services\Interfaces;

interface IEmployeeTimesheetService {

	public function isTimeSheetAlreadyEntered($weekAndYear, $employeeId);
	public function getDatesOfWeek($timesheetDate);
	public function storeTimesheet($request);
	public function validateTimesheet($request);

}
