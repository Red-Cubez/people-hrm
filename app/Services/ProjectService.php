<?php

namespace People\Services;

use People\Repositories\Interfaces\IEmployeeRepository;
use People\Repositories\Interfaces\IProjectRepository;

class ProjectService {

	public $EmployeeRepository;
	public $ProjectRepository;

	public function __construct(
		IEmployeeRepository $employeeRepository,
		IProjectRepository $projectRepository) {
		$this->EmployeeRepository = $employeeRepository;
		$this->ProjectRepository = $projectRepository;
	}

	private function getEmployee($employeeId) {
		return $this->EmployeeRepository->find($employeeId);
	}

	public function ProjectResources($project) {
		return 0;

	}

	public function ProjectCost($project) {
		$totalCost = 0;
		foreach ($project->resources() as $resource) {
			$totalCost = $totalCost + $resource->employee->HourlyRate;
		}
		return $totalCost;
	}

	public function IsOnTime($project) {
		if ($project->ExpectedEndDate === null) {
			return false;
		}
		if ($project->ActualEndDate === null && (date('Y-m-d') > $project->ExpectedEndDate)) {
			return false;
		} elseif ($project->ActualEndDate === null && (date('Y-m-d') <= $project->ExpectedEndDate)) {
			return true;
		}

		if ($project->ActualEndDate !== null && ($project->ExpectedEndDate >= $project->ActualEndDate)) {
			return true;
		}
		return false;
	}
}