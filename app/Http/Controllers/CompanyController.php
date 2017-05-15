<?php

namespace People\Http\Controllers;
use Illuminate\Http\Request;
use People\Models\Company;
use People\Services\CompanyService;
use People\Services\Interfaces\ICompanyService;

class CompanyController extends Controller {

	public $CompanyService;

	public function __construct(ICompanyService $companyService) {

		$this->CompanyService = $companyService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$companies = $this->CompanyService->getAllCompanies();

		return view('companies.index', ['companies' => $companies]);
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

		$this->CompanyService->createCompany($request);

		return redirect('/companies');

	}

	/**
	 * Dsisplay the specified resource.
	 *
	 * @param  \People\Models\Company $company
	 * @return \Illuminate\Http\Responseo
	 */
	public function show(Company $company) {
		//below query is nothing,its just to use companyaddress model in this controller.will be handled soon
		list($company, $CompanyAddress) = $this->CompanyService->getCompanyAddressAndCompanyProjects($company);

		//	$companyAddress = CompanyAddress::orderBy('created_at', 'asc')->where('company_id', '$company')->get();
		///dd($companyAddress[]);
		return view('companies/showCompany',
			['company' => $company],
			['CompanyAddress' => $CompanyAddress]

		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Company $company) {
		return view('companies/companyEditForm', ['company' => $company]);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Company $company) {
		$this->CompanyService->updateCompany($request, $company);

		return redirect('/companies');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Company $company) {
		//TODO: HG - check for company dependencies before deleting a company
		$this->CompanyService->deleteCompany($company);

		return redirect('/companies');
	}
}
