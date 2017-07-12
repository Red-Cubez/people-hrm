<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Services\Interfaces\ICompanyHolidayService;
use People\Services\Interfaces\ICompanyService;
use People\Services\Interfaces\IEmployeeService;
use People\Services\Interfaces\IJobTitleService;

class CompanyController extends Controller
{

    public $CompanyService;
    public $JobTitleService;
    public $EmployeeService;
    public $CompanyHolidayService;

    public function __construct(ICompanyService $companyService, IJobTitleService $jobTitleService,

                                IEmployeeService $employeeService, ICompanyHolidayService $companyHolidayService)
    {

        $this->CompanyService = $companyService;
        $this->JobTitleService = $jobTitleService;
        $this->EmployeeService = $employeeService;
        $this->CompanyHolidayService = $companyHolidayService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = $this->CompanyService->getAllCompanies();

        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('companies.addNewCompany');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->CompanyService->createCompany($request);

        return redirect('/companies');

    }

    /**
     * Dsisplay the specified resource.
     *
     * @param  \People\Models\Company $company
     * @return \Illuminate\Http\Responseo
     */
    public function show(Company $company)
    {
//dd($company);
        $companyJobTitles = $this->JobTitleService->getJobTitlesOfCompany($company->id);
        $companyHolidays = $this->CompanyHolidayService->getCompanyHolidays($company->id);
//        dd($company);
        $companyCurrentEmployees = $this->EmployeeService->getAllEmployeesOfCompany($company->id);
        $companyCurrentClients = $this->EmployeeService->getAllClientsOfCompany($company->id);
//        dd($company);
        $employeesWithBirthday = $this->EmployeeService->getAllEmployeesWithBirthDayThisMonth($company);
//        dd($company);
        list($company, $companyAddress) = $this->CompanyService->getCompanyAddressAndCompanyProjects($company);
//        dd($company);
        $companyProfileModel = $this->CompanyService->mapCompanyProfile($company, $companyAddress,
            $companyJobTitles, $employeesWithBirthday, $companyHolidays, $companyCurrentEmployees, $companyCurrentClients);
        $employeesWithBirthday = $companyProfileModel->employeesBirthday;


        return view('companies/showCompany',
            [
                'companyProfileModel' => $companyProfileModel,
                'employeesWithBirthday'=>$employeesWithBirthday,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies/companyEditForm', ['company' => $company]);

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
        $this->CompanyService->updateCompany($request, $company);

        return redirect('/companies/' . $company->id);
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
        $this->CompanyService->deleteCompany($company);

        return redirect('/companies');
    }
}
