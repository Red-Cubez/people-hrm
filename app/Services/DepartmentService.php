<?php

namespace People\Services;

use People\Models\Company;
use People\Models\Department;
use People\Services\Interfaces\IDepartmentService;

class DepartmentService implements IDepartmentService
{

    public function createDepartment($createRequest)
    {

        $department = new Department();
        $department->name = $createRequest->name;
        $company = Company::find(1);

        $department->company_id = $company->id;
        $department->save();
    }

    public function getAllDepartments()
    {
        $departments = Department::orderBy('created_at', 'asc')->get();
        return $departments;
    }

    public function updateDepartment($updateRequest, $department)
    {

        $department->name = $updateRequest->name;
        $department->save();
    }

    public function deleteDepartment($department)
    {

        $department->delete();
    }

}