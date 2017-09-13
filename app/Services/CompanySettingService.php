<?php
namespace People\Services;

use People\Models\CompanySetting;
use People\Services\Interfaces\ICompanySettingService;

class CompanySettingService implements ICompanySettingService
{

    public function getCompanySetting($companyId)
    {
        $setting = CompanySetting::where('company_id', $companyId)->first();

        if (isset($setting)) {
            return $setting;

        } else {
            return null;
        }
    }

    public function getCurrencyName($companyId)
    {

        $setting = $this->getCompanySetting($companyId);
        if (isset($setting)) {
            $currencyName = null;
            $currencyName = $setting->currencyName;
            if (isset($currencyName)) {
                return $currencyName;
            } else {
                return null;
            }
        } else {
            return null;
        }

    }
    public function getCompanySettingDetails($settingId)
    {
        $setting = CompanySetting::find($settingId);

        if (isset($setting)) {
            return $setting;

        } else {
            return null;
        }
    }
    public function updateCompanySettings($request, $settingId)
    {
        $setting               = CompanySetting::find($settingId);
        $setting->currencyName = $request->currencyName;
        $setting->save();

        return $setting;
    }

    public function saveCompanySettings($request)
    {
        $setting = new CompanySetting();

        $setting->currencyName = $request->currencyName;
        $setting->company_id   = $request->companyId;

        $setting->save();
    }

}
