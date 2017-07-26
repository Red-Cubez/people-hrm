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
//    public function getDateFromGiveMonthYear()
//    {
    function getWeekDates($date)
    {
        dd($date);
        $week=date("w",strtotime($date));
        $year=date("Y",strtotime($date));
        $dateTime = new \DateTime();
        $dateTime->setISODate($year, $week);
        $week=array();
        $week['monday'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+1 days');
        $week['tuesday'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+1 days');
        $week['wednesday'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+1 days');
        $week['thursday'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+1 days');
        $week['friday'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+1 days');
        $week['saturday'] = $dateTime->format('d-m-Y');
        $dateTime->modify('+1 days');
        $week['sunday'] = $dateTime->format('d-m-Y');
       // return $startAndEndDate;
        dd($week);
        return response()->json();

    }

//        strtotime(sprintf("%4dW%02d", $year, $week))
//
//        $date = new \DateTime('midnight');
//        $date->setISODate($year, $week);
//    }
    public function showTimesheetForm($employeeId)
    {
          $startAndEndDate=$this->getWeekDates(52,2016);
    //     dd($startAndEndDate);
//        $date = new \DateTime('midnight');
//        $date->setISODate(2015, 52);
//        $d = date('d', strtotime('2013W52'));
//        $monday = $date->format("d");
//        //dd($monday);
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
      //  dd($request->timesheetDate);
        $date= $request->timesheetDate;
       dd($request);
          // $date=date("d",strtotime($date));
           $this->getWeekDates($date);
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
