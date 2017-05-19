<?php

namespace People\Services\Interfaces;

interface ICompanyService {
	public function createCompany($request);
	public function updateCompany($request, $company);
	public function deleteCompany($company);
	public function getAllCompanies();
	public function getCompanyAddressAndCompanyProjects($company);


}