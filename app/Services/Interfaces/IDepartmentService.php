<?php

namespace People\Services\Interfaces;

interface IDepartmentService {

	public function createDepartment($createRequest);
	public function deleteDepartment($department);
	public function updateDepartment($updateRequest, $department);
	public function getAllDepartment();

}
