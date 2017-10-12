<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeTimeoffService;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Services\StandardPermissions;

class EmployeeTimeoffController extends Controller
{

    public $EmployeeTimeoffService;
    public $UserAuthenticationService;

    public function __construct(IEmployeeTimeoffService $employeeTimeoffService, IUserAuthenticationService
         $userAuthenticationService) {

        $this->middleware('auth');

        $this->middleware('permission:' . StandardPermissions::createEditTimeoff, ['only' => ['store', 'edit', 'update']]);

        $this->middleware('permission:' . StandardPermissions::deleteTimeoff, ['only' => ['destroy']]);

        $this->middleware('permission:' . StandardPermissions::approveTimeoffs, ['only' => ['showNonApprovedTimeoffsOfEmployees', 'approveTimeoffs', 'show']]);

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

        // $isManager                               = $this->UserAuthenticationService->isManager();
        // $isAdmin                                 = $this->UserAuthenticationService->isAdmin();
        // $isHrManager                             = $this->UserAuthenticationService->isHrManager();
        //  $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($employeeId);
        // $isEmployee                              = $this->UserAuthenticationService->isEmployee();
        // $canEmployeeView                         = false;

        // if ($isEmployee) {
        //     $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($employeeId);

        // }
        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($employeeId);
        $canViewProfile                          = $this->UserAuthenticationService->canEmployeeView($employeeId);
        if ($canViewProfile && $isRequestedEmployeeBelongsToSameCompany) {
            $timeoffs = $this->EmployeeTimeoffService->getTimeoffsOfEmployee($employeeId);

            return view('employeeTimeoff.index',
                [
                    'employeeId' => $employeeId,
                    'timeoffs'   => $timeoffs,

                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
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

        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($request->employeeId);
        $canViewProfile                          = $this->UserAuthenticationService->canEmployeeView($request->employeeId);
        if ($canViewProfile && $isRequestedEmployeeBelongsToSameCompany) {
            $this->validate($request, array(

                'startDate' => 'required|date',
                'endDate'   => 'required|date',

            ));

            $totalCount = $this->EmployeeTimeoffService->countTimeOffs($request->endDate, $request->startDate);
            $totalCount = $totalCount + 1;
            $this->EmployeeTimeoffService->storeTimeoff($totalCount, $request);

            return back();
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

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

        // $isManager   = $this->UserAuthenticationService->isManager();
        // $isAdmin     = $this->UserAuthenticationService->isAdmin();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();

        // if ($isManager || $isAdmin || $isHrManager) {

        $employeesTimeoffs = $this->EmployeeTimeoffService->getNonApprovedTimeoffsOfEmployees();

        return view('employeeTimeoff.showNonApprovedTimeoffsOfEmployees',
            [
                'employeesTimeoffs' => $employeesTimeoffs,
            ]);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($timeoffId)
    {

        // $isManager   = $this->UserAuthenticationService->isManager();
        // $isAdmin     = $this->UserAuthenticationService->isAdmin();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();

        // $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $timeoff = $this->EmployeeTimeoffService->getTimeoff($timeoffId);
        // $canEmployeeView = false;

        if (isset($timeoff)) {
            $isTimeoffBelongsToEmployeeOfCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($timeoff->employee_id);
            //if ($isEmployee) {

            // $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($timeoff->employee->id);

            // }

            $canViewProfile = $this->UserAuthenticationService->canEmployeeView($timeoff->employee_id);
            if ($canViewProfile && $isTimeoffBelongsToEmployeeOfCompany) {

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
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
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

        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($request->employeeId);
        $canViewProfile                          = $this->UserAuthenticationService->canEmployeeView($request->employeeId);
        if ($canViewProfile && $isRequestedEmployeeBelongsToSameCompany) {
            $this->validate($request, array(

                'startDate' => 'required|date',
                'endDate'   => 'required|date',

            ));

            $totalCount = $this->EmployeeTimeoffService->countTimeOffs($request->endDate, $request->startDate);
            $totalCount = $totalCount + 1;
            $employeeId = $this->EmployeeTimeoffService->updateTimeoff($totalCount, $request, $id);

            return redirect('employeetimeoff/' . $employeeId . '/create');
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
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

        // $isManager = $this->UserAuthenticationService->isManager();

        // $isAdmin = $this->UserAuthenticationService->isAdmin();

        // $isEmployee      = $this->UserAuthenticationService->isEmployee();
        // $canEmployeeView = false;
        // if ($isEmployee) {
        //     $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($request->employeeId);

        // }
        //  if ($isManager || $isAdmin || $canEmployeeView) {

        $this->EmployeeTimeoffService->approveTimeoffs($request);

        return back();
        // }
    }

}
