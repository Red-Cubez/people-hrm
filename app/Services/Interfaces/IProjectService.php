<?php

namespace People\Services\Interfaces;

interface IProjectService
{
    public function getProjectDetails($projectModel, $project);
    public function mapResourcesDetailsToClass($currentProjectResources,$isCompanyProject);
}
