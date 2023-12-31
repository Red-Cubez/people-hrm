<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\ProjectResource;
use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Services\StandardPermissions;

class ProjectResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ProjectService;

    public $ProjectResourceService;
    public $ResourceFormValidator;
    public $UserAuthenticationService;
    public $ClientProjectService;
    public $CompanyProjectResourceService;

    public function __construct(IProjectResourceService $projectResourceService, IProjectService $projectService,
        IResourceFormValidator $resourceFormValidator, IUserAuthenticationService $userAuthenticationService, IClientProjectService $clientProjectService, ICompanyProjectResourceService $companyProjectResourceService) {

        $this->middleware('auth');

        $this->middleware('permission:' . StandardPermissions::createEditClientProjectResource . '|' . StandardPermissions::createEditCompanyProjectResource, ['only' => ['manageressources', 'store', 'updateressources']]);

        $this->middleware('permission:' . StandardPermissions::deleteClientProjectResource, ['only' => ['destroy']]);

        $this->ProjectResourceService        = $projectResourceService;
        $this->ProjectService                = $projectService;
        $this->ResourceFormValidator         = $resourceFormValidator;
        $this->UserAuthenticationService     = $userAuthenticationService;
        $this->ClientProjectService          = $clientProjectService;
        $this->CompanyProjectResourceService = $companyProjectResourceService;
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
        $projectId  = null;
        $redirectTo = null;
        if (isset($request->companyProjectId)) {
            $projectId  = $this->CompanyProjectResourceService->saveOrUpdateCompanyProjectResource($request);
            $redirectTo = "/companyprojects/" . $projectId;
        } elseif (isset($request->clientProjectid)) {
            $projectId  = $this->ProjectResourceService->saveOrUpdateProjectResource($request);
            $redirectTo = "/clientprojects/" . $projectId;
        }

        return response()->json(
            [
                'projectId'  => $request->clientProjectid,
                'redirectTo' => $redirectTo,
            ]);

    }

    public function manageressources($clientProjectId)
    {
        //   dd("here");
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();
        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();

        $clientProject = $this->ClientProjectService->getClientProjectDetails($clientProjectId);
        if (isset($clientProject)) {
            $isRequestedClientProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($clientProject->client_id);
            if ($isRequestedClientProjectBelongsToSameCompany) {
                list($currentProjectResources, $availableEmployees) = $this->ProjectResourceService->showClientProjectResources($clientProjectId);

                $projectResources = $this->ProjectService->mapResourcesDetailsToClass($currentProjectResources, false);

                return view('projectResources.index', [
                    'projectResources'   => $projectResources,
                    'availableEmployees' => $availableEmployees,
                    'clientProjectid'    => $clientProjectId,
                ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);

            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }

    }

/**
 * Display the specified resource.
 *
 * @param  \People\Models\ClientProject $clientProject
 * @return \Illuminate\Http\Response
 */
    public function show(ProjectResource $projectresource)
    {
        //
    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  \People\Models\ClientProject $clientProject
 * @return \Illuminate\Http\Response
 */
    public function edit(ProjectResource $projectresource)
    {
        //
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  \People\Models\ClientProject $clientProject
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, ProjectResource $projectresource)
    {

    }

/**
 * Remove the specified resource from storage.
 *
 * @param  \People\Models\ProjectResource $projectresource
 * @return \Illuminate\Http\Response
 */
    public function destroy(ProjectResource $projectresource, Request $request)
    {

        $this->ProjectResourceService->deleteProjectResource($projectresource);

        return redirect('/clientprojects/' . $projectresource->client_project_id . '/projectresources');
    }

    public function updateressources($projectResourceId)
    {

        //edit form

        $resource = $this->ProjectResourceService->getProjectResource($projectResourceId);

        if (isset($resource)) {
            $isRequestedClientProjectResourceBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($resource->clientProject->client->id);

            // $isAdmin         = $this->UserAuthenticationService->isAdmin();
            // $isManager       = $this->UserAuthenticationService->isManager();
            //$isClientManager = $this->UserAuthenticationService->isClientManager();

            if ($isRequestedClientProjectResourceBelongsToSameCompany) {
                return view('projectResources.updateResource', [
                    'projectresources' => $resource,
                    'clientProjectid'  => $resource->client_project_id,

                ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

}
