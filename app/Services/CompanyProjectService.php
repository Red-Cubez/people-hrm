<?php

namespace People\Services;

use People\Models\CompanyProject;
use People\PresentationModels\CompanyProject\ViewCompanyProjectModel;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IProjectService;

class CompanyProjectService implements ICompanyProjectService
{
    public $ProjectService;

    public function __construct(IProjectService $projectService)
    {

        $this->ProjectService = $projectService;
    }

    public function getAllCompanyProjects()
    {
        $companyprojects = CompanyProject::orderBy('created_at', 'asc')->get();
        return $companyprojects;
    }

    public function viewCompanyProject($companyProjectId)
    {
        $companyProject = CompanyProject::find($companyProjectId);

        $isOnTime = $this->isProjectOnTime($companyProject);
        $isOnBudget = $this->isProjectOnBudget($companyProject);

        $companyProjectModel = new ViewCompanyProjectModel();

        return $this->ProjectService->getClientProjectAndCompanyProjectDetails($companyProjectModel, $companyProject, $isOnTime, $isOnBudget);
    }

    private function isProjectOnTime($companyProject)
    {
        $currentDate = date("Y-m-d");
        $isOnTime = "Not On";
        if ($companyProject->expectedEndDate != NULL) {
            if ($companyProject->actualEndDate == NULL) {
                if (($companyProject->expectedEndDate) >= $currentDate) {

                    $isOnTime = "On Time";
                } else {
                    $isOnTime = "Not On Time";
                }
            } else {
                if ($companyProject->actualEndDate <= $companyProject->expectedEndDate) {

                    $isOnTime = "On Time";
                    if (($companyProject->actualEndDate <= $currentDate)) {
                        $isOnTime = "Project Completed ";
                    } elseif (($companyProject->actualEndDate < $companyProject->expectedEndDate)) {
                        $isOnTime = "Completed Before Time ";
                    }
                }
            }
        } //This scenario should not occur. The validation should stop user from have a blank expected end date
        else {
            $isOnTime = "Cannot determine time. Please set expected end date";
        }
        return $isOnTime;
    }

    private function isProjectOnBudget($companyProject)
    {
        $cost = $companyProject->cost;
        $budget = $companyProject->budget;

        if (($cost != NULL) && ($budget != NULL)) {
            if ($cost < $budget) {
                $isOnBudget = "Project is On Budget";
            } else {
                $isOnBudget = "Project is Not On Budget";
            }
        } elseif ($cost == NULL) {
            $isOnBudget = "Budget Cannot determine.Please set cost ";
        } else {
            $isOnBudget = "Budget Cannot determine.Please set budget ";

        }

        return $isOnBudget;
    }

    public function saveCompanyProject($request)
    {
        $companyProject = new CompanyProject();

        $companyProject->name = $request->name;
        $companyProject->expectedStartDate = $request->expectedStartDate;
        $companyProject->expectedEndDate = $request->expectedEndDate;
        $companyProject->actualStartDate = $request->actualStartDate;
        $companyProject->actualEndDate = $request->actualEndDate;
        $companyProject->budget = $request->budget;
        $companyProject->cost = $request->cost;
        $companyProject->company_id = $request->companyid;
        //TODO These properties need to be set from fields
        //TODO this value needs to come from the correct client Project

        $companyProject->save();
    }

    public function updateCompanyProject($request, $companyproject)
    {
        $companyproject->name = $request->name;
        $companyproject->expectedStartDate = $request->expectedStartDate;
        $companyproject->expectedEndDate = $request->expectedEndDate;
        $companyproject->actualStartDate = $request->actualStartDate;
        $companyproject->actualEndDate = $request->actualEndDate;
        $companyproject->budget = $request->budget;
        $companyproject->cost = $request->cost;

        $companyproject->save();
    }

    public function deleteCompanyProject($companyproject)
    {
        $companyproject->delete();
    }

    public function manageProject($companyid)
    {
        $companyProjects = CompanyProject::where('company_id', $companyid)->orderBy('created_at', 'asc')->get();

        return $companyProjects;
    }

}
