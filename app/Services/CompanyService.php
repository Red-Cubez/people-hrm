<?php

namespace People\Services;
use People\Models\Company;
use People\Models\CompanyAddress;
use People\Models\CompanyProject;
use People\Services\Interfaces\ICompanyService;

class CompanyService implements ICompanyService {

	public function createOrUpdateCompanyAddress($userRequest, $companyAddress, $companyId) {

		if (!isset($companyAddress)) {
			$companyAddress = new CompanyAddress();
		}

		$companyAddress->streetLine1 = $userRequest->streetLine1;
		$companyAddress->streetLine2 = $userRequest->streetLine2;
		$companyAddress->country = $userRequest->country;
		$companyAddress->stateProvince = $userRequest->stateProvince;
		$companyAddress->city = $userRequest->city;
		$companyAddress->company_id = $companyId;
		$companyAddress->save();
	}
	public function getCompanyAddressAndCompanyProjects($company) {
		
		$companyAddress = $company->address;
		//$companyProjects=CompanyProject::orderBy('created_at')->where('company_id',$company->id)->get();
	
		return array($company, $companyAddress);

	}

	public function createCompany($request) {

		$company = new Company();
		$company->name = $request->name;
		$company->save();

		$this->createOrUpdateCompanyAddress($request, null, $company->id);

	}
	public function updateCompany($updateRequest, $company) {
		$company->name = $updateRequest->name;

		$this->createOrUpdateCompanyAddress($updateRequest, $company->address, $company->id);

		$company->save();
	}

	public function deleteCompany($company) {
		$company->delete();
	}

	public function getAllCompanies() {
		$companies = Company::orderBy('created_at', 'asc')->get();
		return $companies;
	}

}
