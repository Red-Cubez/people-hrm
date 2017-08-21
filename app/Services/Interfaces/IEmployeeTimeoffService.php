<?php

namespace People\Services\Interfaces;

interface IEmployeeTimeoffService {

	public function isTimeoffAlreadyEntered($startDate,$endDate,$employeeId,$timeoffId);
	// public function getDatesOfWeek($timesheetDate);
	public function storeTimeoff($totalCount,$request);
	public function updateTimeoff($totalCount,$request,$id);
	public function getTimeoffsOfEmployee($employeeId);
	// public function getEmployeeTimesheet($timesheetId);
	public function countTimeOffs($endDate, $startDate);
	public function deleteTimeoff($id);
	public function getTimeoff($id);
	

}
