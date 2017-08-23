<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Models\Employee;
use People\Services\Interfaces\ICompanyHolidayService;
use People\Services\Interfaces\IDepartmentService;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IJobTitleService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Services\Interfaces\IUserAuthenticationService;

class EmployeeController extends Controller
{

    public $EmployeeService;
    public $DepartmentService;
    public $JobTitleService;
    public $EmployeeFormValidator;
    public $CompanyHolidayService;
    public $UserAuthenticationService;
    public function __construct(IEmployeeService $employeeService, IDepartmentService $departmentService,
        IJobTitleService $jobTitleService, IUserAuthenticationService $userAuthenticationService,
        IResourceFormValidator $employeeFormValidator, ICompanyHolidayService $companyHolidayService) {

        $this->middleware('auth', ['only' => ['show']]);

        $this->middleware('isAuthorizedToView');
        $this->EmployeeService           = $employeeService;
        $this->DepartmentService         = $departmentService;
        $this->JobTitleService           = $jobTitleService;
        $this->EmployeeFormValidator     = $employeeFormValidator;
        $this->CompanyHolidayService     = $companyHolidayService;
        $this->UserAuthenticationService = $userAuthenticationService;
    }

    public function validateEmployeeForm(Request $request)
    {
        $formErrors = $this->EmployeeFormValidator->validateEmployeeForm($request);

        return response()->json(
            [
                'formErrors' => $formErrors,
                'action'     => $request->action,
            ]);

    }
    public function showEmployeeForm($companyId)
    {

        $employees   = $this->EmployeeService->getAllEmployees();
        $departments = $this->DepartmentService->getAllDepartments();
        $jobTitles   = $this->JobTitleService->getJobTitlesOfCompany($companyId);

        return view('employees.index',
            [
                'employees'   => $employees,
                'departments' => $departments,
                'jobTitles'   => $jobTitles,
                'companyId'   => $companyId,

            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($companyId)
    {
        dd('got here');

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

        return response()->json(
            [
                'employeeId' => $employeeId,
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show($employeeId)
    {

        $canEmployeeView = $this->UserAuthenticationService->canEmployeeView($employeeId);
        if ($canEmployeeView) {

            $employee      = $this->EmployeeService->getEmployee($employeeId);
            $company       = Company::find($employee->company_id);
            $employeeModel = $this->EmployeeService->viewEmployee($employee);
            //  $departments = $this->EmployeeService->getAllDepartments();
            $companyHolidays       = $this->CompanyHolidayService->getCompanyHolidays($employee->company_id);
            $employeesWithBirthday = $this->EmployeeService->getAllEmployeesWithBirthDayThisMonth($company);
            return view('employees/showEmployee',
                [
                    'employeeModel'         => $employeeModel,
                    'companyHolidays'       => $companyHolidays,
                    'employeesWithBirthday' => $employeesWithBirthday,
                ]);
        } else if (!$canEmployeeView) {
            dd("Acces Denied");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId)
    {

        $employee          = $this->EmployeeService->getEmployee($employeeId);
        $editEmployeeModel = $this->EmployeeService->editEmployee($employee);
        $departments       = $this->EmployeeService->getAllDepartments();
        $jobTitles         = $this->JobTitleService->getJobTitlesOfCompany($employee->company_id);

        return view('employees/update',
            [
                'editEmployeeModel' => $editEmployeeModel,
                'departments'       => $departments,
                'jobTitles'         => $jobTitles,
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $employeeId)
    {

        $employee = $this->EmployeeService->getEmployee($employeeId);
        $this->EmployeeService->updateEmployee($request, $employee);
        return response()->json(
            [
                'employeeId' => $employeeId,
            ]);

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
