<?php
namespace People\Services;

use People\Models\EmployeeTimeoff;
use People\services\Interfaces\IEmployeeTimeoffService;

class EmployeeTimeoffService implements IEmployeeTimeoffService
{

    public function getTimeoffsOfEmployee($employeeId)
    {
        return EmployeeTimeoff::orderBy('created_at', 'asc')->where('employee_id', $employeeId)->get();

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

}
