<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Department;
use People\Services\DepartmentService;
use People\Services\Interfaces\IDepartmentService;

class DepartmentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public $DepartmentService;

	public function __construct(IDepartmentService $departmentService) {

		$this->DepartmentService = $departmentService;
	}

	public function index() {

		$departments = $this->DepartmentService->getAllDepartments();

		return view('departments.index', ['departments' => $departments]);
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
		$this->DepartmentService->createDepartment($request);

		return redirect('/departments');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\Department $department
	 * @return \Illuminate\Http\Response
	 */
	public function show(Department $department) {
		return view('departments/update',
			['department' => $department]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\Depaertment  $department
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Department $department) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\Department  $department
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Department $department) {

		$this->DepartmentService->updateDepartment($request, $department);
		return redirect('/departments');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\Department  $department
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Department $department) {
		$this->DepartmentService->deleteDepartment($department);

		return redirect('/departments');
	}
}
