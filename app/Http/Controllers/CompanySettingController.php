<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\ICompanySettingService;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Services\StandardPermissions;

class CompanySettingController extends Controller
{

    public $CompanySettingService;
    public $UserAuthenticationService;

    public function __construct(ICompanySettingService $companySettingService,
        IUserAuthenticationService $userAuthenticationService) {

        $this->middleware('auth');

        $this->middleware('permission:'.StandardPermissions::createShowEditDeleteCompanySettings);

        $this->CompanySettingService     = $companySettingService;
        $this->UserAuthenticationService = $userAuthenticationService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function createSettings($companyId)
    {

        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        // $isManager                           = $this->UserAuthenticationService->isManager();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->
            isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
            return view('companySettings/create',
                [
                    'companyId' => $companyId,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'currencyName'   => 'required|max:255',
            'currencySymbol' => 'required|max:255',
        ));
        $this->CompanySettingService->saveCompanySettings($request);

        return redirect('company-settings/' . $request->companyId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyId)
    {

        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        // $isManager                           = $this->UserAuthenticationService->isManager();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->
            isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
            $companySetting = $this->CompanySettingService->getCompanySetting($companyId);

            return view('companySettings/show',
                [
                    'companySetting' => $companySetting,
                    'companyId'      => $companyId,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companySettingId)
    {
        // $isAdmin        = $this->UserAuthenticationService->isAdmin();
        // $isManager      = $this->UserAuthenticationService->isManager();
        $companySetting = $this->CompanySettingService->getCompanySettingDetails($companySettingId);

        if (isset($companySetting)) {
            $isRequestedSettingBelongsToCompany = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companySetting->company_id);
            if ($isRequestedSettingBelongsToCompany) {

                return view('companySettings/edit',
                    [
                        'companySetting' => $companySetting,

                    ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $settingId)
    {
        $this->validate($request, array(
            'currencyName'   => 'required|max:255',
            'currencySymbol' => 'required|max:255',
        ));
        $companySetting = $this->CompanySettingService->updateCompanySettings($request, $settingId);

        return redirect('companies/'.$companySetting->company_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
