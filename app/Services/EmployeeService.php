<?php

namespace People\Services;
use People\Models\Employee;
use People\Models\Department;
use People\Models\Company;
use People\Services\Interfaces\IEmployeeService;

class EmployeeService implements IEmployeeService {

	public function getAllEmployees()
	{

		$employees = Employee::orderBy('created_at', 'asc')->get();
		$departments = Department::orderBy('created_at', 'asc')->get();
	 	 return array($employees,$departments);
	 	}

	public function deleteEmployee($employee)
	{
	 	$employee->departments()->detach();
		$employee->delete();
	}
  	public function createOrUpdateEmployee($request,$employee,$updateRequest)
  	{
       
       if(!isset($employee))
       {
       	$company = Company::find(1);

		$employee = new Employee();
       }
  	    $employee->firstName = $request->firstName;
		$employee->lastName = $request->lastName;
		$employee->hireDate = $request->hireDate;
		$employee->terminationDate = $request->terminationDate;
		$employee->jobTitle = $request->jobTitle;
		$employee->annualSalary = $request->annualSalary;
		$employee->hourlyRate = $request->hourlyRate;
		$employee->save();
		if(isset($updateRequest))
		{
		$employee->departments()->detach();
	    }
		if (count($request->departmentList) > 0) {
			foreach ($request->departmentList as $employeeDepartmentId) {
				$employeeDepartment  = Department::find($employeeDepartmentId);

				$employee->departments()->save($employeeDepartment);
		
			}
		} 		

  	}

    public function createEmployee($request)
    {
        $this->createOrUpdateEmployee($request,null,null);
  

    	}
	public function updateEmployee($request,$employee)
   	 {  
   	 	$updateRequest=1;
        $this->createOrUpdateEmployee($request,$employee,$updateRequest);
		
	}
	public function showEmployee($employee)
   	 {

	     $employeeDepartmentIds = [];
		foreach ($employee->departments as $department) 
		{
			
			array_push($employeeDepartmentIds, $department->id);
		}

		$departments = Department::orderBy('created_at', 'asc')->get();
		return array($employee,$departments,$employeeDepartmentIds);
	}



}
