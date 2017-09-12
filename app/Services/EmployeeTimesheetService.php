<?php
namespace People\Services;

use Illuminate\Support\Facades\Auth;
use People\Models\Employee;
use People\Models\EmployeeTimesheet;
use People\Services\Interfaces\IEmployeeService;
use People\services\Interfaces\IEmployeeTimesheetService;

class EmployeeTimesheetModel
{
    public $id;
    public $weekNoAndYear;
    public $weekStartDate;
    public $weekEndDate;
    public $isApproved;
    public $employeeName;
    public $employeeId;
    public $billableWeeklyHours;
    public $nonBillableWeeklyHours;
}

class EmployeeTimesheetService implements IEmployeeTimesheetService
{

    public $EmployeeService;
    public function __construct(IEmployeeService $employeeService)
    {

        $this->EmployeeService = $employeeService;
    }

    public function getTimesheetsWithWeekStartAndEndDate($employeeId)
    {

        $employeeTimesheets = EmployeeTimesheet::where('employee_id', $employeeId)->get();
        $timehseets         = array();
        foreach ($employeeTimesheets as $employeeTimesheet) {
            $employeeTimesheetModel                = new EmployeeTimesheetModel;
            $employeeTimesheetModel->id            = $employeeTimesheet->id;
            $employeeTimesheetModel->weekNoAndYear = $employeeTimesheet->weekNoAndYear;
            $employeeTimesheetModel->weekStartDate = $this->getWeekStartDate($employeeTimesheet->weekNoAndYear);
            $employeeTimesheetModel->weekEndDate   = $this->getWeekEndDate($employeeTimesheet->weekNoAndYear);
            $employeeTimesheetModel->isApproved    = $employeeTimesheet->isApproved;
            $employeeTimesheetModel->employeeName  = $employeeTimesheet->employee->firstName . ' ' . $employeeTimesheet->employee->lastName;
            $employeeTimesheetModel->employeeId    = $employeeTimesheet->employee->id;

            $employeeTimesheetModel->billableWeeklyHours = $this->calculateTimesheetHours($employeeTimesheet->billableWeeklyTimesheet);
            $employeeTimesheetModel->nonBillableWeeklyHours = $this->calculateTimesheetHours($employeeTimesheet->nonBillableWeeklyTimesheet);

            array_push($timehseets, $employeeTimesheetModel);
        }
        return $timehseets;

    }
    public function calculateTimesheetHours($weeklyTimesheet)
    {
        $timesheet  = json_decode($weeklyTimesheet, true);
        $totalHours = $timesheet['friday'] + $timesheet['monday'] + $timesheet['sunday'] + $timesheet['tuesday'] +
            $timesheet['saturday'] + $timesheet['thursday'] + $timesheet['wednesday'];
        return $totalHours;
    }

    public function isTimeSheetAlreadyEntered($weekAndYear, $employeeId)
    {
        $isAlreadyEntered  = false;
        $employeeTimeSheet = EmployeeTimesheet::where('weekNoAndYear', $weekAndYear)->where('employee_id', $employeeId)->get();
        if (count($employeeTimeSheet) > 0) {
            $isAlreadyEntered = true;
        }
        return $isAlreadyEntered;
    }
    public function getWeekStartDate($weekNoAndYear)
    {

        $monday = date('d-m-Y', strtotime($weekNoAndYear));

        return $monday;

    }
    public function getNonApprovedTimesheetsOfEmployees()
    {
        $user                = Auth::user();
        $companyId           = $user->employee->company_id;
        $employees           = $this->EmployeeService->getAllEmployeesOfCompany($companyId);
        $employeesTimesheets = $this->getTimesheets($employees);

        return $employeesTimesheets;
    }
    public function getTimesheets($employees)
    {

        $employeesTimesheets = [];

        foreach ($employees as $employee) {

            $employeeTimesheets = $this->getTimesheetsWithWeekStartAndEndDate($employee->id);

            foreach ($employeeTimesheets as $employeeTimesheet) {
                if ($employeeTimesheet->isApproved == 0) {
                    array_push($employeesTimesheets, $employeeTimesheet);
                }

            }
        }

        return $employeesTimesheets;
    }

    public function getWeekEndDate($weekNoAndYear)
    {

        $week           = array();
        $week['monday'] = date('d-m-Y', strtotime($weekNoAndYear));
        $monday         = $week['monday'];

        $date = new \DateTime($monday);

        $week['sunday'] = $date->modify('+6 day')->format('d-m-Y');

        return $week['sunday'];

    }
    public function getDatesOfWeek($timesheetDate)
    {

        $week           = array();
        $week['monday'] = date('d-m-Y', $timesheetDate);
        $monday         = $week['monday'];

        $date              = new \DateTime($monday);
        $week['tuesday']   = $date->modify('+1 day')->format('d-m-Y');
        $week['wednesday'] = $date->modify('+1 day')->format('d-m-Y');
        $week['thursday']  = $date->modify('+1 day')->format('d-m-Y');
        $week['friday']    = $date->modify('+1 day')->format('d-m-Y');
        $week['saturday']  = $date->modify('+1 day')->format('d-m-Y');
        $week['sunday']    = $date->modify('+1 day')->format('d-m-Y');

        return $week;
    }
    public function approveTimesheets($request)
    {
        if (isset($request->areApproved)) {

            foreach ($request->areApproved as $timesheetId) {
                $timesheet             = EmployeeTimesheet::find($timesheetId);
                $timesheet->isApproved = 1;
                $timesheet->save();

            }
        }

    }
    public function storeTimesheet($request)
    {
        $timesheet = new EmployeeTimesheet();

        $timesheet->employee_id   = $request->employeeId;
        $timesheet->weekNoAndYear = $request->timesheetDate;

        $billableDays                       = $timesheet->billableWeeklyTimeSheet;
        $billableDays['monday']             = $request->mondayBillable;
        $billableDays['tuesday']            = $request->tuesdayBillable;
        $billableDays['wednesday']          = $request->wednesdayBillable;
        $billableDays['thursday']           = $request->thursdayBillable;
        $billableDays['friday']             = $request->fridayBillable;
        $billableDays['saturday']           = $request->saturdayBillable;
        $billableDays['sunday']             = $request->sundayBillable;
        $timesheet->billableWeeklyTimeSheet = $billableDays;

        $nonBillableDays                       = $timesheet->billableWeeklyTimeSheet;
        $nonBillableDays['monday']             = $request->mondayNonBillable;
        $nonBillableDays['tuesday']            = $request->tuesdayNonBillable;
        $nonBillableDays['wednesday']          = $request->wednesdayNonBillable;
        $nonBillableDays['thursday']           = $request->thursdayNonBillable;
        $nonBillableDays['friday']             = $request->fridayNonBillable;
        $nonBillableDays['saturday']           = $request->saturdayNonBillable;
        $nonBillableDays['sunday']             = $request->sundayNonBillable;
        $timesheet->nonBillableWeeklyTimeSheet = $nonBillableDays;

        $timesheet->isApproved = 0;
        $timesheet->save();
    }
    public function updateTimesheet($request, $id)
    {

        $timesheet = EmployeeTimesheet::find($id);

        $billableDays                       = $timesheet->billableWeeklyTimeSheet;
        $billableDays['monday']             = $request->mondayBillable;
        $billableDays['tuesday']            = $request->tuesdayBillable;
        $billableDays['wednesday']          = $request->wednesdayBillable;
        $billableDays['thursday']           = $request->thursdayBillable;
        $billableDays['friday']             = $request->fridayBillable;
        $billableDays['saturday']           = $request->saturdayBillable;
        $billableDays['sunday']             = $request->sundayBillable;
        $timesheet->billableWeeklyTimeSheet = $billableDays;

        $nonBillableDays                       = $timesheet->billableWeeklyTimeSheet;
        $nonBillableDays['monday']             = $request->mondayNonBillable;
        $nonBillableDays['tuesday']            = $request->tuesdayNonBillable;
        $nonBillableDays['wednesday']          = $request->wednesdayNonBillable;
        $nonBillableDays['thursday']           = $request->thursdayNonBillable;
        $nonBillableDays['friday']             = $request->fridayNonBillable;
        $nonBillableDays['saturday']           = $request->saturdayNonBillable;
        $nonBillableDays['sunday']             = $request->sundayNonBillable;
        $timesheet->nonBillableWeeklyTimeSheet = $nonBillableDays;

        $timesheet->save();
        return $timesheet->employee_id;

    }

    public function getTimesheetsOfEmployee($employeeId)
    {

        $timesheets = $this->getTimesheetsWithWeekStartAndEndDate($employeeId);

        return $timesheets;
    }
    public function getEmployeeTimesheet($timesheetId)
    {

        $employeeTimesheet= EmployeeTimesheet::find($timesheetId);
        if($employeeTimesheet)
        {
            return $employeeTimesheet;
        }
        else
        {
            return null;
        }
    }
}
