<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IEmployeeTimesheetService;
use People\Services\Interfaces\IUserAuthenticationService;

class EmployeeTimesheetController extends Controller
{

    public $EmployeeTimesheetService;
    public $UserAuthenticationService;
    public function __construct(IEmployeeTimesheetService $employeeTimesheetService, IUserAuthenticationService
         $userAuthenticationService) {
        $this->middleware('auth');
        $this->EmployeeTimesheetService  = $employeeTimesheetService;
        $this->UserAuthenticationService = $userAuthenticationService;
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

        $isManager                               = $this->UserAuthenticationService->isManager();
        $isAdmin                                 = $this->UserAuthenticationService->isAdmin();
        $isHrManager                             = $this->UserAuthenticationService->isHrManager();
        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($employeeId);

        $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $canEmployeeView = false;
        if ($isEmployee) {
            $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($employeeId);

        }
        if (($isManager || $isAdmin || $isHrManager || $canEmployeeView) && $isRequestedEmployeeBelongsToSameCompany) {
            $timesheets = $this->EmployeeTimesheetService->getTimesheetsOfEmployee($employeeId);

            return view('employeeTimesheet.create',
                [
                    'employeeId' => $employeeId,
                    'timesheets' => $timesheets,

                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    public function store(Request $request)
    {

        $isManager   = $this->UserAuthenticationService->isManager();
        $isAdmin     = $this->UserAuthenticationService->isAdmin();
        $isHrManager = $this->UserAuthenticationService->isHrManager();

        $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $canEmployeeView = false;
        if ($isEmployee) {
            $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($request->employeeId);

        }
        if ($isManager || $isAdmin || $isHrManager || $canEmployeeView) {

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
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    ////view readonly to admin
    public function show($id)
    {
        $timesheet = $this->EmployeeTimesheetService->getEmployeeTimesheet($id);

        if (isset($timesheet)) {
            $isTimesheetBelongsToEmployeeOfCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($timesheet->employee_id);

            $isManager   = $this->UserAuthenticationService->isManager();
            $isAdmin     = $this->UserAuthenticationService->isAdmin();
            $isHrManager = $this->UserAuthenticationService->isHrManager();

            if (($isManager || $isAdmin || $isHrManager) && $isTimesheetBelongsToEmployeeOfCompany) {

                $billableWeeklyTimesheet    = json_decode($timesheet->billableWeeklyTimesheet, true);
                $nonBillableWeeklyTimesheet = json_decode($timesheet->nonBillableWeeklyTimesheet, true);
                $weekDates                  = $this->EmployeeTimesheetService->getDatesOfWeek(strtotime($timesheet->weekNoAndYear));
                $showReadOnly               = true;

                return view('employeeTimesheet.edit',
                    [

                        'timesheet'                  => $timesheet,
                        'billableWeeklyTimesheet'    => $billableWeeklyTimesheet,
                        'nonBillableWeeklyTimesheet' => $nonBillableWeeklyTimesheet,
                        'weekDates'                  => $weekDates,
                        'showReadOnly'               => $showReadOnly,
                    ]);

            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }

    }
    public function showNonApprovedTimesheetsOfEmployees()
    {
        $isManager   = $this->UserAuthenticationService->isManager();
        $isAdmin     = $this->UserAuthenticationService->isAdmin();
        $isHrManager = $this->UserAuthenticationService->isHrManager();

        if ($isManager || $isAdmin || $isHrManager || $canEmployeeView) {
            $employeesTimesheets = $this->EmployeeTimesheetService->getNonApprovedTimesheetsOfEmployees();

            return view('employeeTimesheet.showNonApprovedTimesheetsOfEmployees',
                [
                    'employeesTimesheets' => $employeesTimesheets,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $isManager       = $this->UserAuthenticationService->isManager();
        $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $isAdmin         = $this->UserAuthenticationService->isAdmin();
        $canEmployeeView = false;
        $timesheet       = $this->EmployeeTimesheetService->getEmployeeTimesheet($id);

        if (isset($timesheet)) {
            $isTimesheetBelongsToEmployeeOfCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($timesheet->employee_id);

            if ($isEmployee) {

                if (isset($timesheet)) {
                    $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($timesheet->employee->id);
                } else {

                    return $this->UserAuthenticationService->redirectToErrorMessageView(null);
                }

            }
            if (($isManager || $isAdmin || $canEmployeeView) && $isTimesheetBelongsToEmployeeOfCompany) {

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
 * @param  \Illuminate\Http\Request $request
 * @param  int $id
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, $id)
    {

        $isAdmin         = $this->UserAuthenticationService->isAdmin();
        $isEmployee      = $this->UserAuthenticationService->isEmployee();
        $canEmployeeView = false;
        if ($isEmployee) {
            $timesheet = $this->EmployeeTimesheetService->getEmployeeTimesheet($id);

            if (isset($timesheet)) {
                $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($timesheet->employee->id);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }

        }
        if ($isAdmin || $canEmployeeView) {
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
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }

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
