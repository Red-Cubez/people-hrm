<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Company;
use People\Models\CompanyAddress;

class CompanyController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$companies = Company::orderBy('created_at', 'asc')->get();

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

		$company = new Company();
		$companyaddress = new CompanyAddress();
		$company->name = $request->name;
		$company->save();

		$companyaddress->streetLine1 = $request->streetLine1;
		$companyaddress->streetLine2 = $request->streetLine2;
		$companyaddress->country = $request->country;
		$companyaddress->stateProvince = $request->stateProvince;
		$companyaddress->city = $request->city;
		$companyaddress->company_id = $company->id;
		$companyaddress->save();
		return redirect('/companies');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\Company $company
	 * @return \Illuminate\Http\Response
	 */
	public function show(Company $company) {
		return view('companies/update', ['company' => $company]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Company $company) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Company $company) {

		$company->name = $request->name;

		if (!isset($company->address)) {
			$companyaddress = new CompanyAddress();
			$companyaddress->company_id = $company->id;
			$company->address = new $companyaddress;
		}
		$company->address->streetLine1 = $request->streetLine1;
		$company->address->streetLine2 = $request->streetLine2;
		$company->address->country = $request->country;
		$company->address->stateProvince = $request->stateProvince;
		$company->address->city = $request->city;
		$company->address->streetLine1 = $request->streetLine1;
		$company->save();
		$company->address->save();

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
		$company->delete();
		return redirect('/companies');
	}
}
