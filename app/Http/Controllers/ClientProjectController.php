<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\ClientProject;
use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanySettingService;
use People\Services\Interfaces\IProjectGrapher;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Services\Interfaces\IUserAuthenticationService;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $ClientProjectService;
    public $ProjectGrapher;
    public $ProjectService;
    public $ProjectResourceService;
    public $ProjectFormValidator;
    public $UserAuthenticationService;
    public $CompanySettingService;

    public function __construct(IClientProjectService $clientProjectService, IProjectGrapher $projectGrapher,
        IProjectService $projectService, IProjectResourceService $projectResourceService,
        IResourceFormValidator $projectFormValidator, IUserAuthenticationService
         $userAuthenticationService, ICompanySettingService $companySettingService) {

        $this->middleware('auth');
        $this->middleware('permission:create/edit-clientProject', ['only' => ['createProject', 'store', 'edit', 'update']]);
        $this->middleware('permission:view-clientProject', ['only' => ['show']]);
        $this->middleware('permission:delete-clientProject', ['only' => ['destroy']]);

        $this->ClientProjectService      = $clientProjectService;
        $this->ProjectGrapher            = $projectGrapher;
        $this->ProjectService            = $projectService;
        $this->ProjectResourceService    = $projectResourceService;
        $this->ProjectFormValidator      = $projectFormValidator;
        $this->UserAuthenticationService = $userAuthenticationService;
        $this->CompanySettingService     = $companySettingService;
    }

    public function index(Request $request)
    {

        $clientProjects = $this->ClientProjectService->getClientProjects();

        return view('clientprojects.index',
            [
                'clientProjects' => $clientProjects,
                'companyId'      => $request->companyId,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function validateProjectForm(Request $request)
    {
        $formErrors = $this->ProjectFormValidator->validateProjectForm($request);

        return response()->json(
            [
                'formErrors' => $formErrors,
                'action'     => $request->action,
            ]);

    }
    public function store(Request $request)
    {

        $clientProject = $this->ClientProjectService->createClientProject($request);

        return response()->json(
            [
                'projectId' => $clientProject->id,
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\ClientProject $clientProject
     * @return \Illuminate\Http\Response
     */

    public function show($clientProjectId)
    {

        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();
        $clientProject   = $this->ClientProjectService->getClientProjectDetails($clientProjectId);

        if (isset($clientProject)) {
            $isRequestedClientProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($clientProject->client_id);
            if ($isRequestedClientProjectBelongsToSameCompany) {

                $clientProjectModel = $this->ClientProjectService->viewClientProject($clientProjectId);
                $clientProjects     = $this->ClientProjectService->getClientProjectDetails($clientProjectId);

                list($currentProjectResources, $availableEmployees) = $this->ProjectResourceService->showClientProjectResources($clientProjectId);

                $projectResources = $this->ProjectService->mapResourcesDetailsToClass($currentProjectResources, false);
                $projectTimeLines = $this->ProjectGrapher->setupProjectCost($clientProjectModel, $projectResources, false);

                $projectTotalCost = $this->ProjectGrapher->calculateProjectTotalCost($projectTimeLines);
                $resourcesDetails = $this->ProjectGrapher->getResourcesTotalCostForProject($clientProjectModel, $projectResources, $projectTotalCost);

                $clientProjectModel->cost              = $projectTotalCost;
                $isOnBudget                            = $this->ProjectService->isProjectOnBudget($projectTotalCost, $clientProjectModel->budget);
                $clientProjectModel->isProjectOnBudget = $isOnBudget;
                $currencyName                          = $this->CompanySettingService->
                    getCurrencyName($clientProject->client->company_id);
                $currencySymbol = $this->CompanySettingService->
                    getCurrencySymbol($clientProject->client->company_id);
                return view('clientProjects/viewClientProject',
                    [
                        'project'          => $clientProjectModel,
                        'projectTimeLines' => $projectTimeLines,
                        'resourcesDetails' => $resourcesDetails,
                        'projectTotalCost' => $projectTotalCost,
                        'currencyName'     => $currencyName,
                        'currencySymbol'   => $currencySymbol,

                    ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    /**
    cified resource.
     *
     * @param  \People\Models\ClientProject $clientProject
     * @return \Illuminate\Http\Response
     */
    public function edit($clientProjectId)
    {

        // $isManager     = $this->UserAuthenticationService->isManager();
        // $isAdmin       = $this->UserAuthenticationService->isAdmin();
        $clientProject = $this->ClientProjectService->getClientProjectDetails($clientProjectId);

        if (isset($clientProject)) {
            $isRequestedClientProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($clientProject->client_id);
            if ($isRequestedClientProjectBelongsToSameCompany) {

                return view('clientProjects/clientProjectEditForm', ['clientProject' => $clientProject]);
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
     * @param  \People\Models\ClientProject $clientProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientProject $clientproject)
    {

        $clientid = $this->ClientProjectService->updateClientProject($request, $clientproject);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\ClientProject $clientproject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientProject $clientproject)
    {
       
        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();

       // if ($isManager || $isAdmin) {
            $clientid = $this->ClientProjectService->deleteClientProject($clientproject);

            return redirect('/clients/' . $clientid);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        // }
    }

    public function createProject($clientId)
    {

        // $isManager                             = $this->UserAuthenticationService->isManager();
        // $isAdmin                               = $this->UserAuthenticationService->isAdmin();
        $isRequestedClientBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($clientId);
        if ($isRequestedClientBelongsToSameCompany) {

            $clientProjects = $this->ClientProjectService->manageClientProjects($clientId);

            return view('clientprojects.index',
                ['clientProjects' => $clientProjects,
                    'clientId'        => $clientId,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

}
