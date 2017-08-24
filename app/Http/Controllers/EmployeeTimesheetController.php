<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeTimesheetService;

class EmployeeTimesheetController extends Controller
{

    public $EmployeeTimesheetService;
    public function __construct(IEmployeeTimesheetService $employeeTimesheetService)
    {

        $this->EmployeeTimesheetService = $employeeTimesheetService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //using
    }

    public function getWeekDates(Request $request)
    {

        $isAlreadyEntered = $this->EmployeeTimesheetService->isTimeSheetAlreadyEntered($request->timesheetDate, $request->employeeId);
        $weekDates        = $this->EmployeeTimesheetService->getDatesOfWeek(strtotime($request->timesheetDate));

        return response()->json(
            [
                'isAlreadyEntered' => $isAlreadyEntered,
                'week'             => $weekDates,
            ]);

    }

    public function createTimesheet($employeeId)
    {

        $timesheets = $this->EmployeeTimesheetService->getTimesheetsOfEmployee($employeeId);

        return view('employeeTimesheet.create',
            [
                'employeeId' => $employeeId,
                'timesheets' => $timesheets,

            ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            'timesheetDate'        => 'required',
            'mondayBillable'       => 'required|integer|min:0|max:40',
            'tuesdayBillable'      => 'required|integer|min:0|max:40',
            'wednesdayBillable'    => 'required|integer|min:0|max:40',
            'thursdayBillable'     => 'required|integer|min:0|max:40',
            'fridayBillable'       => 'required|integer|min:0|max:40',
            'saturdayBillable'     => 'nullable|integer|min:0|max:40',
            'sundayBillable'       => 'nullable|integer|min:0|max:40',

            'mondayNonBillable'    => 'nullable|integer|min:0|max:40',
            'tuesdayNonBillable'   => 'nullable|integer|min:0|max:40',
            'wednesdayNonBillable' => 'nullable|integer|min:0|max:40',
            'thursdayNonBillable'  => 'nullable|integer|min:0|max:40',
            'fridayNonBillable'    => 'nullable|integer|min:0|max:40',
            'saturdayNonBillable'  => 'nullable|integer|min:0|max:40',
            'sundayNonBillable'    => 'nullable|integer|min:0|max:40',

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
    public function show($id)
    {

    }
    public function showNonApprovedTimesheetsOfEmployees()
    {
        $employeesTimesheets = $this->EmployeeTimesheetService->getNonApprovedTimesheetsOfEmployees();
        
        return view('employeetimesheet.showNonApprovedTimesheetsOfEmployees',
            [
                'employeesTimesheets' => $employeesTimesheets,
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        dd($request);

        $timesheet                  = $this->EmployeeTimesheetService->getEmployeeTimesheet($id);
        $billableWeeklyTimesheet    = json_decode($timesheet->billableWeeklyTimesheet, true);
        $nonBillableWeeklyTimesheet = json_decode($timesheet->nonBillableWeeklyTimesheet, true);
        $weekDates                  = $this->EmployeeTimesheetService->getDatesOfWeek(strtotime($timesheet->weekNoAndYear));

        return view('employeeTimesheet.edit',
            [

                'timesheet'                  => $timesheet,
                'billableWeeklyTimesheet'    => $billableWeeklyTimesheet,
                'nonBillableWeeklyTimesheet' => $nonBillableWeeklyTimesheet,
                'weekDates'                  => $weekDates,

            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, array(

            'mondayBillable'       => 'required|integer|min:0|max:40',
            'tuesdayBillable'      => 'required|integer|min:0|max:40',
            'wednesdayBillable'    => 'required|integer|min:0|max:40',
            'thursdayBillable'     => 'required|integer|min:0|max:40',
            'fridayBillable'       => 'required|integer|min:0|max:40',
            'saturdayBillable'     => 'nullable|integer|min:0|max:40',
            'sundayBillable'       => 'nullable|integer|min:0|max:40',

            'mondayNonBillable'    => 'nullable|integer|min:0|max:40',
            'tuesdayNonBillable'   => 'nullable|integer|min:0|max:40',
            'wednesdayNonBillable' => 'nullable|integer|min:0|max:40',
            'thursdayNonBillable'  => 'nullable|integer|min:0|max:40',
            'fridayNonBillable'    => 'nullable|integer|min:0|max:40',
            'saturdayNonBillable'  => 'nullable|integer|min:0|max:40',
            'sundayNonBillable'    => 'nullable|integer|min:0|max:40',

        ));

        $employeeId = $this->EmployeeTimesheetService->updateTimesheet($request, $id);
        return redirect('employeetimesheet/' . $employeeId . '/create');

    }
    public function approveTimesheets(Request $request)
    { 
        $this->EmployeeTimesheetService->approveTimesheets($request);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
