<?php

namespace People\Services\Interfaces;

interface IReportService
{

 
   public function getInternalProjectsTimeLines($companyId,$startDate,$endDate);

   public function getClientProjectsTimeLines($companyId);
   


}