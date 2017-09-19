<?php

namespace People\Services;

use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IProjectGrapher;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IReportService;

class ReportService implements IReportService
{
    public $ProjectGrapher;
    public $CompanyProjectService;
    public $CompanyProjectResourceService;
    public $ClientProjectService;
    public $ProjectService;
    public $ProjectResourceService;

    public function __construct(IProjectGrapher $projectGrapher, ICompanyProjectService $companyProjectService, ICompanyProjectResourceService $companyProjectResourceService,
        IClientProjectService $clientProjectService, IProjectService $projectService, IProjectResourceService $projectResourceService) {

        $this->ProjectGrapher                = $projectGrapher;
        $this->CompanyProjectService         = $companyProjectService;
        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ClientProjectService          = $clientProjectService;
        $this->ProjectService                = $projectService;
        $this->ProjectResourceService        = $projectResourceService;

    }

    public function getInternalProjectsTimeLines($companyId, $startDate, $endDate)
    {
        $companyInternalProjectsTimeLines = array();
        $companyInternalProjects          = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId, $startDate, $endDate);

        foreach ($companyInternalProjects as $companyInternalProject) {

            list($projectStartDate, $projectEndDate) = $this->CompanyProjectService->getProjectStartAndEndDate($companyInternalProject);
        
            if (($startDate <= $projectEndDate) && ($projectStartDate <= $endDate)
                && ($startDate <= $endDate) && ($projectStartDate <= $projectEndDate)) {
            
                $projectsTimeLines = $this->getInternalProjectTimeLines($companyInternalProject->id,$startDate,$endDate);

                array_push($companyInternalProjectsTimeLines, $projectsTimeLines);
            }
        }
        d
        return $companyInternalProjectsTimeLines;
    }
    public function getInternalProjectTimeLines($companyProjectId,$startDate,$endDate)
    {
        list($currentProjectResources) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);

        $companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

        $projectTimeLines = $this->ProjectGrapher->setupProjectCost($companyProject, $currentProjectResources, true);

        return $projectTimeLines;
    }

    public function getClientProjectsTimeLines($companyId)
    {
        $clientProjectsTimeLines = array();
        $clients                 = $this->ClientProjectService->getAllClientsOfCompanyWithProjects($companyId);

        foreach ($clients as $client) {
            foreach ($client->projects as $project) {

                $projectsTimeLines = $this->getClientProjectTimeLines($project->id);

                array_push($clientProjectsTimeLines, $projectsTimeLines);
            }
        }

        return $clientProjectsTimeLines;

    }

    public function getClientProjectTimeLines($clientProjectId)
    {
        $clientProjects                                     = $this->ClientProjectService->getClientProjectDetails($clientProjectId);
        $clientProjectModel                                 = $this->ClientProjectService->viewClientProject($clientProjectId);
        list($currentProjectResources, $availableEmployees) = $this->ProjectResourceService->showClientProjectResources($clientProjectId);

        $projectResources = $this->ProjectService->mapResourcesDetailsToClass($currentProjectResources, false);
        $projectTimeLines = $this->ProjectGrapher->setupProjectCost($clientProjectModel, $projectResources, false);

        return $projectTimeLines;
    }

}
