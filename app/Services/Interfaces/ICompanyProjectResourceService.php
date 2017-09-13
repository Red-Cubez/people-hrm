<?php

namespace People\Services\Interfaces;

interface ICompanyProjectResourceService
{
    public function showCompanyProjectResources($companyProjectId);
    public function saveOrUpdateCompanyProjectResource($request);
    public function deleteCompanyProjectResource($companyprojectresource);
    public function showEditForm($companyProjectId);
    public function getCompanyProjectResource($companyProjectResourceId);

}
