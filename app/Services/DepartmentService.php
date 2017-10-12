<?php

namespace People\Services;

use People\Models\Department;
use People\Services\Interfaces\IDepartmentService;

class DepartmentService implements IDepartmentService
{

    public function createDepartment($request)
    {

        $department = new Department();

        $department->name       = $request->name;
        $department->company_id = $request->companyId;

        $department->save();

        return $department;
    }

    public function getAllDepartments()
    {
        $departments = Department::orderBy('created_at', 'asc')->get();
        return $departments;
    }

    public function updateDepartment($request, $departmentId)
    {
        $department=$this->getDepartment($departmentId);
        $department->name = $request->name;
        $department->save();

        return $department;
    }
     public function getDepartment($departmentId)
    {
        return Department::find($departmentId);
    }

    public function deleteDepartment($departmentId)
    {
        $department=Department::find($departmentId);

        $department->delete();
    }
    public function getDepartmentsOfCompany($companyId)
    {
        return Department::where('company_id', $companyId)->get();
    }

}
