<?php

namespace People\Services\Interfaces;

interface IReportService
{

 
   public function getInternalProjectsTimeLines($companyId);
   public function getClientProjectsTimeLines($companyId);
   


}