<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeTimeoffService;

class EmployeeTimeoffController extends Controller
{
    public $EmployeeTimeoffService;
    public function __construct(IEmployeeTimeoffService $employeeTimeoffService)
    {

        $this->EmployeeTimeoffService = $employeeTimeoffService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId)
    {

    }
    public function createTimeoff($employeeId)
    {
        $timeoffs = $this->EmployeeTimeoffService->getTimeoffsOfEmployee($employeeId);

        return view('employeeTimeoff.index',
            [
                'employeeId' => $employeeId,
                'timeoffs'   => $timeoffs,

            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(

            'startDate' => 'required',
            'endDate'   => 'required',

        ));

        $totalCount = $this->EmployeeTimeoffService->countTimeOffs($request->endDate, $request->startDate);

        $this->EmployeeTimeoffService->storeTimeoff($totalCount,$request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->EmployeeTimeoffService->deleteTimeoff($id);

        return back();
    }
    public function validateTimeoffDates(Request $request)
    {

        $isAlreadyEntered = $this->EmployeeTimeoffService->isTimeoffAlreadyEntered(
            $request->startDate,
            $request->endDate,
            $request->employeeId
        );

        return response()->json(
            [
                'isAlreadyEntered' => $isAlreadyEntered,

            ]);

    }
}
