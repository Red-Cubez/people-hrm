<?php

namespace People\Services;

use People\Services\Interfaces\IResourceFormValidator;

class FormErrors
{

    public $hasErrors;
    public $employeeNotSelected;
    public $startDateNotEntered;
    public $endDateNotEntered;
    public $wrongEndDate;

}

class EmployeeFormErrors
{
    public $hasErrors;
    public $WrongHireDate;
    public $wrongTerminationDate;

}

class ResourceFormValidator implements IResourceFormValidator
{
    public function validateProjectForm($request)
    {
        $formErrors = new FormErrors();

        $formErrors->hasErrors = false;
        $startDate = null;
        $endDate = null;

        if ($request->actualStartDate != '' || $request->actualStartDate != null) {
            $startDate = $request->actualStartDate;
        } else if ($request->expectedStartDate != '' || $request->expectedStartDate != null) {
            $startDate = $request->expectedStartDate;
        }

        if ($request->actualEndDate != '' || $request->actualEndDate != null) {
            $endDate = $request->actualEndDate;
        } else if ($request->expectedEndDate != '' || $request->expectedEndDate != null) {
            $endDate = $request->expectedEndDate;
        }
        if ($startDate == null) {
            $formErrors->startDateNotEntered = "Please Enter Expected Start Date or Actual  Start Date";
            $formErrors->hasErrors = true;
        }

        if ($endDate == null) {
            $formErrors->endDateNotEntered = "Please Enter Expected End Date or Actual  End Date";
            $formErrors->hasErrors = true;
        }
        if ($endDate < $startDate) {
            $formErrors->wrongEndDate = "End Date Can not be smaller than Start Date";
            $formErrors->hasErrors = true;
        }

        return $formErrors;
    }

    public function validateForm($request)
    {

        $formErrors = new FormErrors();

        $formErrors->hasErrors = false;
        $startDate = null;
        $endDate = null;

        if ($request->actualStartDate != '' || $request->actualStartDate != null) {
            $startDate = $request->actualStartDate;
        } else if ($request->expectedStartDate != '' || $request->expectedStartDate != null) {
            $startDate = $request->expectedStartDate;
        }

        if ($request->actualEndDate != '' || $request->actualEndDate != null) {
            $endDate = $request->actualEndDate;
        } else if ($request->expectedEndDate != '' || $request->expectedEndDate != null) {
            $endDate = $request->expectedEndDate;
        }

        if (($request->resource == "employee") && ($request->employee_id == '' || ($request->employee_id == null))) {
            $formErrors->employeeNotSelected = "Please Select Employee From List";
            $formErrors->hasErrors = true;
        }
        if ($startDate == null) {
            $formErrors->startDateNotEntered = "Please Enter Expected Start Date or Actual  Start Date";
            $formErrors->hasErrors = true;
        }

        if ($endDate == null) {
            $formErrors->endDateNotEntered = "Please Enter Expected End Date or Actual  End Date";
            $formErrors->hasErrors = true;
        }
        if ($endDate < $startDate) {
            $formErrors->wrongEndDate = "End Date Can not be smaller than Start Date";
            $formErrors->hasErrors = true;
        }


        return $formErrors;
    }

    public function validateEmployeeForm($request)

    {
        $formErrors = new EmployeeFormErrors();

        $formErrors->hasErrors = false;
        $wrongTerminationDate = null;
        $wrongHireDate = null;
        $hireDateNotEntered = null;

        if (($request->hireDate != null) && ($request->hireDate < $request->birthDate)) {
            $formErrors->wrongHireDate = "Hire date can not be smaller than birth Date";
            $formErrors->hasErrors = true;
        }
        if (($request->terminationDate != null) && ($request->terminationDate < $request->hireDate)) {
            $formErrors->wrongTerminationDate = "Termination date can not be smaller than Hire Date";
            $formErrors->hasErrors = true;
        }
        if (($request->terminationDate != null) && ($request->hireDate ==null )) {
            $formErrors->hireDateNotEntered="Please Enter Hire Date If you want to enter Termination Date";
            $formErrors->hasErrors = true;

        }

        return $formErrors;
    }

}