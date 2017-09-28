<?php

namespace People\Services\Interfaces;

interface IProjectResourceService
{

    public function saveOrUpdateProjectResource($request);

    public function deleteProjectResource($projectresource);

    public function updateProjectRessources($clientid);

    public function manageProjectResources($clientproject);
    public function showClientProjectResources($clientProjectId);
    public function getProjectResource($projectResourceId);

    public function  getResourceStartAndEndDate($resource);

}