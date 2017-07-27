<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;

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

    public function isTimeSheetAlreadyEntered($weekAndYear)
    {
        //
    }

    function getWeekDates(Request $request)
    {
     //   $this->isTimeSheetAlreadyEntered($request->timesshhetDate);
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
       // dd($request->timesheetDate);
        $date= $request->timesheetDate;

          // $date=date("d",strtotime($date));
         //  $this->getWeekDates($date);
     //   dd($date);
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
