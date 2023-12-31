<?php

namespace People\Services\Interfaces;

interface IResourceFormValidator
{
    public function validateForm($request);

    public function validateProjectForm($request);

    public function validateEmployeeForm($request);

    public function validateJobTitleForm($jobTitleName);

    public function validateHolidayForm($request);
    public function validateDepartmentForm($departmentName);

}
