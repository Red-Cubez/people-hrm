<?php

namespace People\Http\Controllers;

use People\Models\Employee;
use People\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'asc')->get();

        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        //TODO These properties need to be set from fields
        $employee->hireDate = date("Ymd");
        $employee->terminationDate = date("Ymd");
        $employee->jobTitle = 'Title 1';
        $employee->annualSalary = 100000;
        $employee->hourlyRate = 41;

        //$employee->company = $company;
        $employee->save();

        return redirect('/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \People\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
      //  Task::findOrFail($id)->delete();
    $employee->delete();
        return redirect('/employees');
    }
}
