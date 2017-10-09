<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Services\Interfaces\ICompanyHolidayService;
use People\Services\Interfaces\ICompanyService;
use People\Services\Interfaces\IDepartmentService;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IJobTitleService;
use People\Services\Interfaces\IUserAuthenticationService;

class CompanyController extends Controller
{

    public $CompanyService;
    public $JobTitleService;
    public $EmployeeService;
    public $CompanyHolidayService;
    public $DepartmentService;
    public $UserAuthenticationService;

    public function __construct(ICompanyService $companyService, IJobTitleService $jobTitleService,

        IEmployeeService $employeeService, ICompanyHolidayService $companyHolidayService, IUserAuthenticationService $userAuthenticationService,
        IDepartmentService $departmentService) {

        $this->middleware('auth');
        $this->middleware( 'permission:create/delete-companies' , ['only' => ['create' ,'destroy','store']]);
        $this->middleware( 'permission:view-company' , [ 'only' => ['show']]);
        $this->middleware( 'permission:edit/update-company' , [ 'only' => ['edit','update']]);

        $this->CompanyService            = $companyService;
        $this->JobTitleService           = $jobTitleService;
        $this->EmployeeService           = $employeeService;
        $this->CompanyHolidayService     = $companyHolidayService;
        $this->DepartmentService         = $departmentService;
        $this->UserAuthenticationService = $userAuthenticationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();

        // if ($isManager || $isAdmin) {
            $companies = $this->CompanyService->getAllCompanies();

            return view('companies.index', ['companies' => $companies]);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();
        // if ($isManager || $isAdmin) {
            return view('companies.addNewCompany');
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
    //     $isManager = $this->UserAuthenticationService->isManager();
    //     $isAdmin   = $this->UserAuthenticationService->isAdmin();
    //     if ($isManager || $isAdmin) {
            $this->validate($request, array(
                'name' => 'required|max:255',
            ));
            $this->CompanyService->createCompany($request);

            return redirect('/companies');
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }

    /**
     * Dsisplay the specified resource.
     *
     * @param  \People\Models\Company $company
     * @return \Illuminate\Http\Responseo
     */
    public function show($companyId)
    {

        // $isManager                           = $this->UserAuthenticationService->isManager();
        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        // $isHrManager                         = $this->UserAuthenticationService->isHrManager();
        // $isClientManager                     = $this->UserAuthenticationService->isClientManager();
         $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
            $company          = $this->CompanyService->getCompanyDetails($companyId);
            $companyJobTitles = $this->JobTitleService->getJobTitlesOfCompany($company->id);
            $companyHolidays  = $this->CompanyHolidayService->getCompanyHolidays($company->id);

            $companyCurrentEmployees = $this->EmployeeService->getAllEmployeesOfCompany($company->id);
            $companyCurrentClients   = $this->EmployeeService->getAllClientsOfCompany($company->id);

            $employeesWithBirthday = $this->EmployeeService->getAllEmployeesWithBirthDayThisMonth($company);

            list($company, $companyAddress) = $this->CompanyService->getCompanyAddressAndCompanyProjects($company);

            $companyDepartments = $this->DepartmentService->getDepartmentsOfCompany($company->id);

            $companyProfileModel = $this->CompanyService->mapCompanyProfile($company, $companyAddress,
                $companyJobTitles, $employeesWithBirthday, $companyHolidays, $companyCurrentEmployees, $companyCurrentClients,
                $companyDepartments);
            $employeesWithBirthday = $companyProfileModel->employeesBirthday;
            return view('companies/showCompany',
                [
                    'companyProfileModel'   => $companyProfileModel,
                    'employeesWithBirthday' => $employeesWithBirthday,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit($companyId)
    {

        // $isManager                           = $this->UserAuthenticationService->isManager();
        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
            $company = $this->CompanyService->getCompanyDetails($companyId);
            return view('companies/companyEditForm',
                [
                    'company' => $company,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \People\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();
        // if ($isManager || $isAdmin) {
            $this->validate($request, array(
                'name' => 'required|max:255',
            ));
            $this->CompanyService->updateCompany($request, $company);

            return redirect('/companies/' . $company->id);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //TODO: HG - check for company dependencies before deleting a company
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();
        // if ($isManager || $isAdmin) {
            $this->CompanyService->deleteCompany($company);

            return redirect('/companies');
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }

    }
}
