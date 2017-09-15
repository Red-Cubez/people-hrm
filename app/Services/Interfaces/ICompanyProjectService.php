<?php

namespace People\Services\Interfaces;

interface ICompanyProjectService {
	public function getAllCompanyProjects();
	public function manageProject($companyid);
	public function deleteCompanyProject($companyproject);
	public function saveCompanyProject($request);
	public function updateCompanyProject($request, $companyproject);
	public function viewCompanyProject($companyProjectId);
	public function getCompanyProject($companyProjectId);
	public function getAllInternalProjectsOfCompany($companyId);


}