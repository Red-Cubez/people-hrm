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

        $companyProjectModel = new ViewCompanyProjectModel();

        return $this->ProjectService->getProjectDetails($companyProjectModel, $companyProject);
    }
    public function getAllInternalProjectsOfCompany($companyId)
    {
        $companyProjects = CompanyProject::orderBy('created_at', 'asc')->where('company_id', $companyId)->get();
        
        if (isset($companyProjects)) {
            return $companyProjects;
        } else {
            return null;
        }

    }

public function getInternalProjectsWithin($companyId, $startDate, $endDate)
    {
        // $companyProjects = CompanyProject::where('company_id', $companyId)->where()->where()->get();
        
        if (isset($companyProjects)) {
            return $companyProjects;
        } else {
            return null;
        }

    }


    public function getProjectStartAndEndDate($project)
    {
        $startDate=null;
        $endDate=null;
        if(isset($project->actualStartDate))
        {

            $startDate=$project->actualStartDate;
        }
        else
        {
            $startDate=$project->expectedStartDate;

        }

        if(isset($project->actualEndDate))
        {

            $endDate=$project->actualEndDate;
        }
        else
        {
            $endDate=$project->expectedEndDate;

        }

        return array($startDate, $endDate);
    }
    public function saveCompanyProject($request)
    {

        $companyProject = new CompanyProject();

        $companyProject->name              = $request->name;
        $companyProject->expectedStartDate = $request->expectedStartDate;
        $companyProject->expectedEndDate   = $request->expectedEndDate;
        $companyProject->actualStartDate   = $request->actualStartDate;
        $companyProject->actualEndDate     = $request->actualEndDate;
        $companyProject->budget            = $request->budget;
        $companyProject->cost              = $request->cost;
        $companyProject->company_id        = $request->companyid;

        $companyProject->save();

        return $companyProject->id;
    }
    public function getCompanyProject($companyProjectId)
    {
        $project = CompanyProject::find($companyProjectId);
        if (isset($project)) {
            return $project;
        } else {
            return null;
        }
    }

    public function updateCompanyProject($request, $companyproject)
    {
        $companyproject->name              = $request->name;
        $companyproject->expectedStartDate = $request->expectedStartDate;
        $companyproject->expectedEndDate   = $request->expectedEndDate;
        $companyproject->actualStartDate   = $request->actualStartDate;
        $companyproject->actualEndDate     = $request->actualEndDate;
        $companyproject->budget            = $request->budget;
        $companyproject->cost              = $request->cost;

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
