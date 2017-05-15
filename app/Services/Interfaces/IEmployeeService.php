<?php

namespace People\Services\Interfaces;

interface IEmployeeService {
	public function createEmployee($request);
	public function updateEmployee($request, $employee);
	public function deleteEmployee($employee);
	public function getAllEmployees();
	public function getAllDepartments();
	public function viewEmployee($employee);
	public function editEmployee($employee);

}