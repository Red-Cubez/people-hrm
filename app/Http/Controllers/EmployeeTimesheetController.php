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

    public function isTimeSheetAlreadyEntered($weekAndYear,$employeeId)
    {
        $isAlreadyEntered=false;
        $employeeTimeSheet=EmployeeTimesheet::where('weekNoAndYear',$weekAndYear )->where('employee_id',$employeeId)->get();
        if(count($employeeTimeSheet)>0)
        {
            $isAlreadyEntered=true;
        }
        return $isAlreadyEntered;

    }

    function getWeekDates(Request $request)
    {
        $isAlreadyEntered=$this->isTimeSheetAlreadyEntered($request->timesheetDate,$request->employeeId);
        $timesheetDate=strtotime($request->timesheetDate);
        $week=array();
        $week['monday'] = date('d-m-Y',$timesheetDate);
        $monday=$week['monday'];

        $date = new \DateTime($monday);
        $week['tuesday'] = $date->modify( '+1 day' )->format('d-m-Y');
        $week['wednesday'] = $date->modify( '+1 day' )->format('d-m-Y');
        $week['thursday'] = $date->modify( '+1 day' )->format('d-m-Y');
        $week['friday'] = $date->modify( '+1 day' )->format('d-m-Y');
        $week['saturday'] = $date->modify( '+1 day' )->format('d-m-Y');
        $week['sunday'] = $date->modify( '+1 day' )->format('d-m-Y');

        return response()->json(
            [
                'isAlreadyEntered'=>$isAlreadyEntered,
                'week'=>$week,
            ]);

    }

    public function showTimesheetForm($employeeId)
    {

        return view('employees.employeeTimeSheet',
            [
                'employeeId' => $employeeId,

            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        "timesheetDate" => null
//      "mondayBillable" => null
//      "tuesdayBillable" => null
//      "wedBillable" => null
//      "thursdayBillable" => null
//      "fridayBillable" => null
//      "saturdayBillable" => null
//      "sundayBillable" => null
//      "mondayNonBillable" => null
//      "tuesdayNonBillable" => null
//      "wedNonBillable" => null
//      "thursdayNonBillable" => null
//      "fridayNonBillable" => null
//      "saturdayNonBillable" => null
//      "sundayNonBillable" => null
       // dd($request);
        $timesheet=new EmployeeTimesheet();

        $timesheet->employee_id=$request->employeeId;
        $timesheet->weekNoAndYear=$request->timesheetDate;

        $billableDays=$timesheet->billableWeeklyTimeSheet;
        $billableDays['monday']=$request->mondayBillable;
        $billableDays['tuesday']=$request->tuesdayBillable;
        $billableDays['wednesday']=$request->wedBillable;
        $billableDays['thursday']=$request->thursdayBillable;
        $billableDays['friday']=$request->fridayBillable;
        $billableDays['saturday']=$request->saturdayBillable;
        $billableDays['sunday']=$request->sundayBillable;
        $timesheet->billableWeeklyTimeSheet = $billableDays;

        $nonBillableDays=$timesheet->billableWeeklyTimeSheet;
        $nonBillableDays['monday']=$request->mondayNonBillable;
        $nonBillableDays['tuesday']=$request->tuesdayNonBillable;
        $nonBillableDays['wednesday']=$request->wedNonBillable;
        $nonBillableDays['thursday']=$request->thursdayNonBillable;
        $nonBillableDays['friday']=$request->fridayNonBillable;
        $nonBillableDays['saturday']=$request->saturdayNonBillable;
        $nonBillableDays['sunday']=$request->sundayNonBillable;
        $timesheet->nonBillableWeeklyTimeSheet = $nonBillableDays;

        $timesheet->save();

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
