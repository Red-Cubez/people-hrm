<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeTimesheetService;

class EmployeeTimesheetController extends Controller {

	public $EmployeeTimesheetService;
	public function __construct(IEmployeeTimesheetService $employeeTimesheetService) {

		$this->EmployeeTimesheetService = $employeeTimesheetService;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//using showTimesheetForm function
	}

	public function getWeekDates(Request $request) {

		$isAlreadyEntered = $this->EmployeeTimesheetService->isTimeSheetAlreadyEntered($request->timesheetDate, $request->employeeId);
		$weekDates = $this->EmployeeTimesheetService->getDatesOfWeek(strtotime($request->timesheetDate));

		return response()->json(
			[
				'isAlreadyEntered' => $isAlreadyEntered,
				'week' => $weekDates,
			]);

	}

	public function createTimesheet($employeeId) {
		//    dd($employeeId);
		$timesheets = $this->EmployeeTimesheetService->getTimesheetsOfEmployee($employeeId);

		//$weekStartAndEndDate = $this->EmployeeTimesheetService->getWeekStartAndEndDate();
		return view('employeeTimesheet.index',
			[
				'employeeId' => $employeeId,
				'timesheets' => $timesheets,

			]);
	}

	public function store(Request $request) {

		$errors = $this->EmployeeTimesheetService->validateTimesheet($request);

		if ($errors) {
			return back()->withErrors('Please Enter All Required Fields');
		} else {

			$this->EmployeeTimesheetService->storeTimesheet($request);

		}
		return back();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

		$timesheet = $this->EmployeeTimesheetService->getEmployeeTimesheet($id);
		$billableWeeklyTimesheet = json_decode($timesheet->billableWeeklyTimesheet, true);
		$nonBillableWeeklyTimesheet = json_decode($timesheet->nonBillableWeeklyTimesheet, true);
		$weekDates = $this->EmployeeTimesheetService->getDatesOfWeek(strtotime($timesheet->weekNoAndYear));

		return view('employeeTimesheet.edit',
			[

				'timesheet' => $timesheet,
				'billableWeeklyTimesheet' => $billableWeeklyTimesheet,
				'nonBillableWeeklyTimesheet' => $nonBillableWeeklyTimesheet,
				'weekDates' => $weekDates,

			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$errors = $this->EmployeeTimesheetService->validateTimesheet($request);

		if ($errors) {
			return back()->withErrors('Please Enter All Required Fields');
		} else {

			$employeeId = $this->EmployeeTimesheetService->updateTimesheet($request, $id);
			return redirect('employeetimesheet/' . $employeeId . '/create');

		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
