<?php
namespace Usman\Timesheet\Http;

use Illuminate\Http\Request;
use Usman\Timesheet\Http\Controller;
use Usman\Timesheet\Services\Interfaces\IEmployeeTimesheetService;

class EmployeeTimesheetController extends Controller {

	public $EmployeeTimesheetService;
	public function __construct(IEmployeeTimesheetService $employeeTimesheetService) {

		$this->EmployeeTimesheetService = $employeeTimesheetService;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Responses
	 */
	public function index() {

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
		//dd("here");
		$timesheets = $this->EmployeeTimesheetService->getTimesheetsOfEmployee($employeeId);

		return view('timesheet::employeeTimesheet.index',
			[
				'employeeId' => $employeeId,
				'timesheets' => $timesheets,

			]);
	}

	public function store(Request $request) {
		//dd($request);
		$this->validate($request, array(
			'timesheetDate' => 'required',
			'mondayBillable' => 'required|min:0|max:40',
			'tuesdayBillable' => 'required|min:0|max:40',
			'wednesdayBillable' => 'required|min:0|max:40',
			'thursdayBillable' => 'required|min:0|max:40',
			'fridayBillable' => 'required|min:0|max:40',

		));

		$this->EmployeeTimesheetService->storeTimesheet($request);

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

		return view('timesheet::employeeTimesheet.edit',
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

		$this->validate($request, array(

			'mondayBillable' => 'required|min:0|max:40',
			'tuesdayBillable' => 'required|min:0|max:40',
			'wednesdayBillable' => 'required|min:0|max:40',
			'thursdayBillable' => 'required|min:0|max:40',
			'fridayBillable' => 'required|min:0|max:40',

		));

		$employeeId = $this->EmployeeTimesheetService->updateTimesheet($request, $id);
		return redirect('employeetimesheet/' . $employeeId . '/create');

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
