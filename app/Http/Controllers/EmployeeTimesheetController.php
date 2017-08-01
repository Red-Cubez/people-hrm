<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\EmployeeTimesheet;

class EmployeeTimesheetController extends Controller
{
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
        //using showTimesheetForm function
    }

    function getWeekDates(Request $request)
    {
        $isAlreadyEntered = $this->isTimeSheetAlreadyEntered($request->timesheetDate, $request->employeeId);
        $timesheetDate = strtotime($request->timesheetDate);
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

        return response()->json(
            [
                'isAlreadyEntered' => $isAlreadyEntered,
                'week' => $week,
            ]);

    }

    public function isTimeSheetAlreadyEntered($weekAndYear, $employeeId)
    {
        $isAlreadyEntered = false;
        $employeeTimeSheet = EmployeeTimesheet::where('weekNoAndYear', $weekAndYear)->where('employee_id', $employeeId)->get();
        if (count($employeeTimeSheet) > 0) {
            $isAlreadyEntered = true;
        }
        return $isAlreadyEntered;

    }

    public function showTimesheetForm($employeeId)
    {

        return view('employees.employeeTimeSheet',
            [
                'employeeId' => $employeeId,

            ]);
    }

    public function store(Request $request)
    {
        $errors = $this->validateTimesheet($request);

        if ($errors) {
            return back()->withErrors(
                [
                    'Please Enter All Required Fields',
                ]);
        } else {

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

            $timesheet->save();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function validateTimesheet($request)
    {
        $errors = false;
        if ($request->timesheetDate == null)
            $errors = true;
        if ($request->mondayBillable == null)
            $errors = true;
        if ($request->tuesdayBillable == null)
            $errors = true;
        if ($request->wednesdayBillable == null)
            $errors = true;
        if ($request->thursdayBillable == null)
            $errors = true;
        if ($request->fridayBillable == null)
            $errors = true;
        if ($request->saturdayBillable == null)
            $errors = true;
        if ($request->sundayBillable == null)
            $errors = true;

        return $errors;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
