<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Models\Employee;
use People\Models\Department;

class EmployeeController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$employees = Employee::orderBy('created_at', 'asc')->get();
		$departments = Department::orderBy('created_at', 'asc')->get();

		return view('employees.index', ['employees' => $employees,'departments'=>$departments]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		//dd($request);
//        $validator = Validator::make($request->all(), [
		//            'name' => 'required|max:255',
		//        ]);
		//
		//        if ($validator->fails()) {
		//            return redirect('/')
		//                ->withInput()
		//                ->withErrors($validator);
		//        }

		//TODO Get company properly
		//        User::find(1);
		$company = Company::find(1);

		$employee = new Employee();
		$employee->firstName = $request->firstName;
		$employee->lastName = $request->lastName;
		$employee->hireDate = $request->hireDate;
		$employee->terminationDate = $request->terminationDate;
		$employee->jobTitle = $request->jobTitle;
		$employee->annualSalary = $request->annualSalary;
		$employee->hourlyRate = $request->hourlyRate;
		$employee->save();
		//TODO These properties need to be set from fields
		// $employee->hireDate = date("Ymd");
		// $employee->terminationDate = date("Ymd");
		// $employee->jobTitle = $request->jobTitle;
		// $employee->annualSalary = 100000;
		// $employee->hourlyRate = 41;
        //$employee->company = $company;
		if (count($request->departmentList) > 0) {
			foreach ($request->departmentList as $employeeDepartmentId) {
				$employeeDepartment  = Department::find($employeeDepartmentId);
				// dd($employeeDepartmentId);
				$employee->departments()->save($employeeDepartment);

				// $employeeDepartment = new EmployeeDepartment();
				// $employeeDepartment->department_id = $employeeDepartment;
				// $employeeDepartment->employee_id = $employee->id;
				// $employeeDepartment->save();
			}
		} 		
		return redirect('/employees');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function show(Employee $employee) {

		$departments = Department::orderBy('created_at', 'asc')->get();
		return view('employees/update',
			['employee' => $employee,
			'departments'=>$departments]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Employee $employee) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Employee $employee) {

		$employee->firstName = $request->firstName;
		$employee->lastName = $request->lastName;
		$employee->hireDate = $request->hireDate;
		$employee->terminationDate = $request->terminationDate;
		$employee->jobTitle = $request->jobTitle;
		$employee->annualSalary = $request->annualSalary;
		$employee->hourlyRate = $request->hourlyRate;
		$employee->save();

		return redirect('/employees');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Employee $employee) {
		$employee->delete();
		return redirect('/employees');
	}
}
