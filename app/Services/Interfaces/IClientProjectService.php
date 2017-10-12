<?php

namespace People\Services\Interfaces;

interface IClientProjectService
{

    public function createClientProject($request);
    public function deleteClientProject($clientproject);
    public function updateClientProject($request, $clientproject);
    public function getClientProjects();
    public function manageClientProjects($clientid);
    public function viewClientProject($clientProjectId);
    public function getClientProjectDetails($clientProjectId);
    public function getAllClientsOfCompanyWithProjects($companyId);
    public function getAllClientProjectsOfCompany($companyId);
    public function getProjectStartAndEndDate($project);

}
