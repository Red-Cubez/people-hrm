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
use People\Services\StandardPermissions;

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

        $this->middleware('auth');

        $this->middleware('permission:' . StandardPermissions::createEditEmployee, ['only' => ['showEmployeeForm', 'store', 'edit', 'update']]);

        $this->middleware('permission:' . StandardPermissions::viewOwnProfile . '|' . StandardPermissions::viewOthersProfile, ['only' => ['show']]);

        $this->middleware('permission:' . StandardPermissions::deleteEmployee, ['only' => ['destroy']]);

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

        // $isManager = $this->UserAuthenticationService->isManager();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();
        // $isAdmin     = $this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
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
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
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

        // $isManager = $this->UserAuthenticationService->isManager();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();
        // $isAdmin     = $this->UserAuthenticationService->isAdmin();

        //if ($isAdmin || $isManager || $isHrManager) {
        $employeeId = $this->EmployeeService->createEmployee($request);

        return response()->json(
            [
                'employeeId' => $employeeId,
            ]);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show($employeeId)
    {

        // $isAdmin              = $this->UserAuthenticationService->isAdmin();
        // $isManager            = $this->UserAuthenticationService->isManager();
        // $isEmployee           = $this->UserAuthenticationService->isEmployee();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();
        //$isClientManager = $this->UserAuthenticationService->isClientManager();

        $canEmployeeView                         = false;
        $isRequestedEmployeeBelongsToSameCompany = false;
        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($employeeId);

        $canViewProfile = $this->UserAuthenticationService->canEmployeeView($employeeId);

        if ($canViewProfile && $isRequestedEmployeeBelongsToSameCompany) {
            $employee = $this->EmployeeService->getEmployee($employeeId);
            if (isset($employee)) {
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
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
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
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();
        // $isAdmin     = $this->UserAuthenticationService->isAdmin();
        $isRequestedEmployeeBelongsToSameCompany = $this->UserAuthenticationService->isRequestedEmployeeBelongsToSameCompany($employeeId);

        if ($isRequestedEmployeeBelongsToSameCompany) {
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
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

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
        // $isManager = $this->UserAuthenticationService->isManager();
        //  $isHrManager = $this->UserAuthenticationService->isHrManager();
        //  $isAdmin     = $this->UserAuthenticationService->isAdmin();

        //if ($isAdmin || $isManager || $isHrManager) {
        $employee = $this->EmployeeService->getEmployee($employeeId);
        $this->EmployeeService->updateEmployee($request, $employee);
        return response()->json(
            [
                'employeeId' => $employeeId,
            ]);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }

    }

/**
 * Remove the specified resource from storage.
 *
 * @param  \People\Models\Employee $employee
 * @return \Illuminate\Http\Response
 */
    public function destroy(Employee $employee)
    {
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isHrManager = $this->UserAuthenticationService->isHrManager();
        // $isAdmin     = $this->UserAuthenticationService->isAdmin();

        //if ($isAdmin || $isManager || $isHrManager) {

        $this->EmployeeService->deleteEmployee($employee);

        return redirect('/companies/' . $employee->company_id);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }

    }
}
