<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Employee;
use People\Services\Interfaces\IDepartmentService;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IJobTitleService;

class EmployeeController extends Controller
{

    public $EmployeeService;
    public $DepartmentService;
    public $JobTitleService;

    public function __construct(IEmployeeService $employeeService, IDepartmentService $departmentService, IJobTitleService $jobTitleService)
    {

        $this->EmployeeService = $employeeService;
        $this->DepartmentService = $departmentService;
        $this->JobTitleService = $jobTitleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $employees = $this->EmployeeService->getAllEmployees();
        $departments = $this->DepartmentService->getAllDepartments();
        $jobTitles = $this->JobTitleService->getJobTitlesOfCompany($request->companyId);

        return view('employees.index',
            [
                'employees' => $employees,
                'departments' => $departments,
                'jobTitles' => $jobTitles,
                'companyId' => $request->companyId,

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $employeeId = $this->EmployeeService->createEmployee($request);

        return redirect('/employees/' . $employeeId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {

        $employeeModel = $this->EmployeeService->viewEmployee($employee);
        $departments = $this->EmployeeService->getAllDepartments();

        return view('employees/showEmployee',
            ['employeeModel' => $employeeModel,
                'departments' => $departments,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {

        $editEmployeeModel = $this->EmployeeService->editEmployee($employee);
        $departments = $this->EmployeeService->getAllDepartments();
        $jobTitles = $this->JobTitleService->getJobTitlesOfCompany($employee->company_id);
        return view('employees/update',
            ['editEmployeeModel' => $editEmployeeModel,
                'departments' => $departments,
                'jobTitles' => $jobTitles,
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Employee $employee)
    {

        $this->EmployeeService->updateEmployee($request, $employee);

        return redirect('/employees/' . $employee->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->EmployeeService->deleteEmployee($employee);

        return redirect('/companies/' . $employee->company_id);
    }
}
