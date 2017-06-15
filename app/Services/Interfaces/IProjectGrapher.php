<?php

namespace People\Services\Interfaces;

interface IProjectGrapher
{

    public function setupProjectCost($projectDetails, $projectResources, $isCompanyProject);

    public function getResourcesTotalCostForProject($projectDetails, $projectResources);
    public function calculateProjectTotalCost($projectTimeLines);


}