<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeTimeoffService;
use People\Services\Interfaces\IUserAuthenticationService;

class EmployeeTimeoffController extends Controller
{

    public $EmployeeTimeoffService;
    public $UserAuthenticationService;

    public function __construct(IEmployeeTimeoffService $employeeTimeoffService, IUserAuthenticationService
         $userAuthenticationService) {
        $this->middleware('auth');
        $this->EmployeeTimeoffService    = $employeeTimeoffService;
        $this->UserAuthenticationService = $userAuthenticationService;

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

        $isManager                               = $this->UserAuthenticationService->isManager();
        $isAdmin                                 = $this->UserAuthenticationService->isAdmin();
        $isHrManager                             = $this->UserAuthenticationService->isHrManager();
        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($employeeId);
        $isEmployee                              = $this->UserAuthenticationService->isEmployee();
        $canEmployeeView                         = false;

        if ($isEmployee) {
            $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($employeeId);

        }
        if (($isManager || $isAdmin || $isHrManager || $canEmployeeView) && $isRequestedEmployeeBelongsToSameCompany) {
            $timeoffs = $this->EmployeeTimeoffService->getTimeoffsOfEmployee($employeeId);

            return view('employeeTimeoff.index',
                [
                    'employeeId' => $employeeId,
                    'timeoffs'   => $timeoffs,

                ]);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]);
        }
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

            'startDate' => 'required|date',
            'endDate'   => 'required|date',

        ));

        $totalCount = $this->EmployeeTimeoffService->countTimeOffs($request->endDate, $request->startDate);
        $totalCount = $totalCount + 1;
        $this->EmployeeTimeoffService->storeTimeoff($totalCount, $request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    ////
    public function show($id)
    {
        //
    }
    public function showNonApprovedTimeoffsOfEmployees()
    {
        $isManager   = $this->UserAuthenticationService->isManager();
        $isAdmin     = $this->UserAuthenticationService->isAdmin();
        $isHrManager = $this->UserAuthenticationService->isHrManager();

        if ($isManager || $isAdmin || $isHrManager) {

            $employeesTimeoffs = $this->EmployeeTimeoffService->getNonApprovedTimeoffsOfEmployees();

            return view('employeeTimeoff.showNonApprovedTimeoffsOfEmployees',
                [
                    'employeesTimeoffs' => $employeesTimeoffs,
                ]);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($timeoffId)
    {

        $isManager   = $this->UserAuthenticationService->isManager();
        $isAdmin     = $this->UserAuthenticationService->isAdmin();
        $isHrManager = $this->UserAuthenticationService->isHrManager();

        $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $timeoff         = $this->EmployeeTimeoffService->getTimeoff($timeoffId);
        $canEmployeeView = false;

        if (isset($timeoff)) {
            $isTimeoffBelongsToEmployeeOfCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($timeoff->employee_id);
            if ($isEmployee) {

                $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($timeoff->employee->id);

            }
            if (($isManager || $isAdmin || $isHrManager || $canEmployeeView) && $isTimeoffBelongsToEmployeeOfCompany) {

                if ($timeoff->is_approved == 0) {
                    return view('employeeTimeoff.edit',
                        [
                            'employeeId' => $timeoff->employee_id,
                            'timeoff'    => $timeoff,

                        ]);

                } elseif ($timeoff->is_approved == 1) {

                    return back();
                }
            } else {
                return view('notAuthorize',
                    [
                        'message' => 'You are Not Authorize to view this Page !!',
                    ]);
            }
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]);
        }

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

        $this->validate($request, array(

            'startDate' => 'required|date',
            'endDate'   => 'required|date',

        ));

        $totalCount = $this->EmployeeTimeoffService->countTimeOffs($request->endDate, $request->startDate);
        $totalCount = $totalCount + 1;
        $employeeId = $this->EmployeeTimeoffService->updateTimeoff($totalCount, $request, $id);

        return redirect('employeetimeoff/' . $employeeId . '/create');

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
            $request->employeeId,
            $request->timeoffId
        );

        return response()->json(
            [
                'isAlreadyEntered' => $isAlreadyEntered,

            ]);

    }
    public function approveTimeoffs(Request $request)
    {
        $isManager = $this->UserAuthenticationService->isManager();

        $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $canEmployeeView = false;
        if ($isEmployee) {
            $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($employeeId);

        }
        if ($isManager || $canEmployeeView) {

            $this->EmployeeTimeoffService->approveTimeoffs($request);
            return back();
        }
    }

}
