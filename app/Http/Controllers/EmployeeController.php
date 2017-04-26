<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Models\Employee;
use People\Models\Department;
use People\Services\EmployeeService;
use People\Services\Interfaces\IEmployeeService;


class EmployeeController extends Controller {

	public $EmployeeService;

	public function __construct(IEmployeeService $employeeService) {

		$this->EmployeeService = $employeeService;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		list($employees,$departments) = $this->EmployeeService->getAllEmployees();

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

			$this->EmployeeService->createEmployee($request);

		//TODO Get company properly
		
		return redirect('/employees');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function show(Employee $employee) {

		list($employee,$departments,$employeeDepartmentIds) = $this->EmployeeService->showEmployee($employee);
		return view('employees/update',
			['employee' => $employee,
			'departments'=>$departments,
			'employeeDepartmentIds' => $employeeDepartmentIds,
			]);
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

       $this->EmployeeService->updateEmployee($request,$employee);
        
		return redirect('/employees');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Employee $employee) {
		$this->EmployeeService->deleteEmployee($employee);

		
		return redirect('/employees');
	}
}
