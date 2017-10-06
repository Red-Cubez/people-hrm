<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProjectResource;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Services\Interfaces\IUserAuthenticationService;

class CompanyProjectResourceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $CompanyProjectResourceService;
    public $ResourceFormValidator;
    public $UserAuthenticationService;
    public $CompanyProjectService;
    public function __construct(ICompanyProjectResourceService $companyProjectResourceService,
        IResourceFormValidator $resourceFormValidator, IUserAuthenticationService
         $userAuthenticationService, ICompanyProjectService $companyProjectService) {
        $this->middleware('auth');
        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ResourceFormValidator         = $resourceFormValidator;
        $this->UserAuthenticationService     = $userAuthenticationService;
        $this->CompanyProjectService         = $companyProjectService;

    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function validateResourceForm(Request $request)
    {
   
        $formErrors = $this->ResourceFormValidator->validateForm($request);

        return response()->json(
            [
                'formErrors' => $formErrors,
            ]);

    }

    public function store(Request $request)
    {
           ////Function use in project resource controller
        // $projectId=$this->CompanyProjectResourceService->saveOrUpdateCompanyProjectResource($request);
        // return redirect("companyprojects/".$projectId);
        // return response()->json(
        //     [
        //         'projectId' => $request->companyProjectId,
        //     ]);

//        return redirect('/companyprojects/'. $request->companyProjectId);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyProjectId)
    {

        $isManager = $this->UserAuthenticationService->isManager();
        $isAdmin   = $this->UserAuthenticationService->isAdmin();
        $project   = $this->CompanyProjectService->getCompanyProject($companyProjectId);

        if (isset($project)) {

            $isRequestedCompanyProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($project->company_id);
            if (($isManager || $isAdmin) && $isRequestedCompanyProjectBelongsToSameCompany) {
                list($currentProjectResources, $availableEmployees) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);
                return view('CompanyProjectResources.index', [
                    'projectResources'   => $currentProjectResources,
                    'availableEmployees' => $availableEmployees,
                    'companyProjectId'   => $companyProjectId,

                ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyProjectResourceId)
    {
      
        $isManager       = $this->UserAuthenticationService->isManager();
        $isAdmin         = $this->UserAuthenticationService->isAdmin();
        $projectResource = $this->CompanyProjectResourceService->getCompanyProjectResource($companyProjectResourceId);
        if (isset($projectResource)) {
            $isRequestedCompanyProjectResourceBelongsToSameCompany = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($projectResource->companyProject->company_id);
            if (($isManager || $isAdmin) && $isRequestedCompanyProjectResourceBelongsToSameCompany) {

                $resource = $this->CompanyProjectResourceService->showEditForm($companyProjectResourceId);

                return view('CompanyProjectResources.updateResource', [
                    'projectresources' => $resource,

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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(CompanyProjectResource $companyprojectresource, Request $request)
    {

        $this->CompanyProjectResourceService->deleteCompanyProjectResource($companyprojectresource);

        return redirect('/companyprojects/' . $request->companyProjectId);
    }

}
