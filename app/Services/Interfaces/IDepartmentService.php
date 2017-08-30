<?php

namespace People\Services\Interfaces;

interface IDepartmentService {

	public function createDepartment($createRequest);
	public function deleteDepartment($departmentId);
	public function updateDepartment($request, $departmentId);
	public function getAllDepartments();
	public function getDepartmentsOfCompany($companyId);
}
