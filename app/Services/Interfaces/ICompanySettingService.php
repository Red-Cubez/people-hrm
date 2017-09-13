<?php

namespace People\Services\Interfaces;

interface ICompanySettingService
{
    public function getCompanySetting($companyId);
    public function getCurrencyName($companyId);
    public function getCompanySettingDetails($settingId);
    public function updateCompanySettings($request, $settingId);
    public function saveCompanySettings($request);
  

}
