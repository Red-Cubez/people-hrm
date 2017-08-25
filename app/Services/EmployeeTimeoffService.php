<?php
namespace People\Services;

use Illuminate\Support\Facades\Auth;
use People\Models\EmployeeTimeoff;
use People\services\Interfaces\IEmployeeService;
use People\services\Interfaces\IEmployeeTimeoffService;

class EmployeeTimeoffModel
{
    public $timeoffId;
    public $startDate;
    public $endDate;
    public $totalCount;
    public $isApproved;
    public $employeeName;
    public $employeeId;
}
class EmployeeTimeoffService implements IEmployeeTimeoffService
{
    public $EmployeeService;
    public function __construct(IEmployeeService $employeeService)
    {

        $this->EmployeeService = $employeeService;
    }
    public function getTimeoffsOfEmployee($employeeId)
    {
        return EmployeeTimeoff::where('employee_id', $employeeId)->get();

    }
    public function mapEmployeeTimeoffToModel($employeeTimeoffs)
    {
        $timeoffs = array();
        foreach ($employeeTimeoffs as $employeeTimeoff) {
            $EmployeeTimeoffModel            = new EmployeeTimeoffModel;
            $EmployeeTimeoffModel->timeoffId = $employeeTimeoff->id;
            $EmployeeTimeoffModel->startDate = $employeeTimeoff->start_date;

            $EmployeeTimeoffModel->endDate      = $employeeTimeoff->end_date;
            $EmployeeTimeoffModel->totalCount   = $employeeTimeoff->total_count;
            $EmployeeTimeoffModel->isApproved   = $employeeTimeoff->is_approved;
            $EmployeeTimeoffModel->employeeName = $employeeTimeoff->employee->firstName . ' ' . $employeeTimeoff->employee->lastName;
            $EmployeeTimeoffModel->employeeId   = $employeeTimeoff->employee->id;

            array_push($timeoffs, $EmployeeTimeoffModel);
        }
        return $timeoffs;
    }

    public function getNonApprovedTimeoffsOfEmployees()
    {
        $user              = Auth::user();
        $companyId         = $user->employee->company_id;
        $employees         = $this->EmployeeService->getAllEmployeesOfCompany($companyId);
        $employeesTimeoffs = $this->getTimeoffs($employees);

        return $employeesTimeoffs;
    }
    public function getTimeoffs($employees)
    {

        $employeesTimeoffs = [];

        foreach ($employees as $employee) {

            $employeeTimeoffs     = $this->getTimeoffsOfEmployee($employee->id);
            $employeeTimeoffModel = $this->mapEmployeeTimeoffToModel($employeeTimeoffs);
            foreach ($employeeTimeoffModel as $employeeTimeoff) {
                if ($employeeTimeoff->isApproved == 0) {
                    array_push($employeesTimeoffs, $employeeTimeoff);
                }

            }
        }

        return $employeesTimeoffs;
    }
    public function isTimeoffAlreadyEntered($startDate, $endDate, $employeeId, $timeoffId)
    {

        $isAlreadyEntered = false;
        if (isset($timeoffId)) {

            $employeeTimeoffs = EmployeeTimeoff::where('id', '!=', $timeoffId)->where('employee_id', $employeeId)->get();

        } else {

            $employeeTimeoffs = EmployeeTimeoff::where('employee_id', $employeeId)->get();
        }

        foreach ($employeeTimeoffs as $employeeTimeoff) {
            if (($startDate <= $employeeTimeoff->end_date) && ($employeeTimeoff->start_date <= $endDate)
                && ($startDate <= $endDate) && ($employeeTimeoff->start_date <= $employeeTimeoff->end_date)) {
                $isAlreadyEntered = true;
            }
        }

        return $isAlreadyEntered;
    }
    public function countTimeOffs($endDate, $startDate)
    {
        $date1 = date_create($startDate);
        $date2 = date_create($endDate);
        $diff  = date_diff($date1, $date2);
        return $diff->days;
    }

    public function storeTimeoff($totalCount, $request)
    {
        $timeoff              = new EmployeeTimeoff();
        $timeoff->employee_id = $request->employeeId;
        $timeoff->start_date  = $request->startDate;
        $timeoff->end_date    = $request->endDate;
        $timeoff->total_count = $totalCount;
        $timeoff->is_approved = 0;

        $timeoff->save();

    }
    public function updateTimeoff($totalCount, $request, $id)
    {
        $timeoff = EmployeeTimeoff::find($id);

        $timeoff->start_date  = $request->startDate;
        $timeoff->end_date    = $request->endDate;
        $timeoff->total_count = $totalCount;
        $timeoff->is_approved = 0;

        $timeoff->save();

        return $timeoff->employee_id;

    }
    public function getTimeoff($id)
    {
        return EmployeeTimeoff::find($id);
    }
    public function deleteTimeoff($id)
    {
        $timeoff = EmployeeTimeoff::find($id);

        $timeoff->delete();
    }
    public function approveTimeoffs($request)
    {
        if (isset($request->areApproved)) {

            foreach ($request->areApproved as $timeoffId) {
                $timeoff              = EmployeeTimeoff::find($timeoffId);
                $timeoff->is_approved = 1;
                $timeoff->save();

            }
        }

    }

}
