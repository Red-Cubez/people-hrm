<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Models\Department;

class DepartmentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$departments = Department::orderBy('created_at', 'asc')->get();

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


		//TODO Get company properly
		
		$company = Company::find(1);

		$department = new Department();
		$department->name = $request->name;
	
		$department->save();
		

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
         
		$department->name = $request->name;
		
		$department->save();
		return redirect('/departments');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\Department  $department
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Department $department) {
		$department->delete();
		return redirect('/departments');
	}
}
