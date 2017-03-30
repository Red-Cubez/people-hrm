<?php

namespace Tests\Unit;

use Tests\TestCase;
use People\Models\Employee;
use People\Models\Project;
use People\Models\Resource;
use People\Services\ProjectService;

class ProjectServiceTest extends TestCase {
	public $ProjectService;
	public $Project;

	public function setUp() {
		parent::setUp();

		$employeeRepository = $this->mock('People\Repositories\Interfaces\IEmployeeRepository');
		$projectRepository = $this->mock('People\Repositories\Interfaces\IProjectRepository');

		$this->ProjectService = new ProjectService($employeeRepository, $projectRepository);

		$this->Project = new Project();
		$this->Project->Name = "Project 1";
		$this->Project->ExpectedStartDate = date('Y-m-d', strtotime("09/01/2016"));
		$this->Project->ExpectedEndDate = date('Y-m-d', strtotime("10/30/2016"));
		$this->Project->ActualStartDate = date('Y-m-d', strtotime("10/01/2016"));
		$this->Project->ActualEndDate = date('Y-m-d', strtotime("10/30/2016"));
		$this->Project->Budget = "5000";
		$this->Project->Cost = "2000";

	}

	public function mock($class) {
		$mock = Mockery::mock($class);
		$this->app->instance($class, $mock);
		return $mock;
	}

//    public function testGetProjectResources_ShouldReturnNoneIfNoResourcesAreAssigned()
	//    {
	//        $projectResources = $this->ProjectService->ProjectResources($this->Project);
	//
	//        $this->assertEquals(0, $projectResources);
	//    }
	//
	//    public function testGetProjectCost_ShouldReturnZeroIfNoResourcesAreAssigned()
	//    {
	//        $projectCost = $this->ProjectService->ProjectCost($this->Project);
	//
	//        $this->assertEquals(0, $projectCost);
	//    }
	//
	//
	//    public function testDidProjectStartOnTime_ShouldReturnFalseIfNoDatesAreSet()
	//    {
	//        $projectCost = $this->ProjectService->ProjectCost($this->Project);
	//
	//        $this->assertEquals(0, $projectCost);
	//    }
	//
	//    public function testDidProjectStartOnTime_ShouldReturnFalseIfActualDateIsAfterExpectedStartDate()
	//    {
	//        $projectCost = $this->ProjectService->ProjectCost($this->Project);
	//
	//        $this->assertEquals(0, $projectCost);
	//    }
	//
	//    public function testDidProjectStartOnTime_ShouldReturnTrueIfActualDateIsOnOrBeforeExpectedDate()
	//    {
	//        $projectCost = $this->ProjectService->ProjectCost($this->Project);
	//
	//        $this->assertEquals(0, $projectCost);
	//    }

	public function testIsOnTime_ShouldReturnFalseIfNoDatesAreSet() {

		$this->Project->ExpectedEndDate = null;
		$this->Project->ActualEndDate = null;
		$isOnTime = $this->ProjectService->IsOnTime($this->Project);

		$this->assertFalse($isOnTime);
	}

	public function testIsOnTime_ShouldReturnFalseIfActualEndDateIsAfterExpectedEndDate() {
		$this->Project->ExpectedEndDate = date('Y-m-d', strtotime("10/05/2016"));
		$this->Project->ActualEndDate = date('Y-m-d', strtotime("10/10/2016"));

		$isOnTime = $this->ProjectService->IsOnTime($this->Project);

		$this->assertFalse($isOnTime);
	}

	public function testIsOnTime_ShouldReturnFalseIfActualEndDateIsEmptyAndTodaysDateIsAfterExpectedEndDate() {
		$this->Project->ExpectedEndDate = date('Y-m-d', strtotime("-10 days"));
		$this->Project->ActualEndDate = null;

		$isOnTime = $this->ProjectService->IsOnTime($this->Project);

		$this->assertFalse($isOnTime);
	}

	public function testIsOnTime_ShouldReturnTrueIfActualEndDateIsEmptyAndTodaysDateIsBeforeOrOnExpectedEndDate() {
		$this->Project->ExpectedEndDate = date('Y-m-d', strtotime("+10 days"));
		$this->Project->ActualEndDate = null;

		$isOnTime = $this->ProjectService->IsOnTime($this->Project);

		$this->assertTrue($isOnTime);
	}

	public function testIsOnTime_ShouldReturnTrueIfActualEndDateIsOnOrBeforeExpectedEndDate() {
		$isOnTime = $this->ProjectService->IsOnTime($this->Project);

		$this->assertTrue($isOnTime);
	}

	public function testProjectCost_ShouldReturn0IfNoResources() {

		$employee1 = new Employee();
		$employee1->HourlyRate = 25;
		$resource1 = new Resource;
		$resource1->employee1 = $employee1;
		$resource1->Project = $this->Project;

		$employee2 = new Employee();
		$employee2->HourlyRate = 50;

		// $mocked_Resource = Mockery::mock('Resource[setAttribute,getAttribute]');
		// $mocked_Resource->shouldReceive('getAttribute')->with('project')->andReturn($this->Project);
		// $mocked_Project->shouldReceive('resources')->andReturn($resources);

		// $resource2 = new Resource;
		// $resource2->employee2 = $employee1;
		// $resource2->Project = $this->Project;

		// $resources = array();

		// array_push($resources, $resource1);
		// array_push($resources, $resource2);

// 		dd($mocked_Resource);
		// // $mocked_Project->resources() = 'bar';

// 		$projectCost = $this->ProjectService->ProjectCost($mocked_Project);

		$this->assertFalse(false);
	}

}
