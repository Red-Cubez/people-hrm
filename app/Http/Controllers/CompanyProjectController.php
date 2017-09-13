<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProject;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\ICompanySettingService;
use People\Services\Interfaces\IProjectGrapher;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Services\Interfaces\IUserAuthenticationService;

class CompanyProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $CompanyProjectService;
    public $CompanyProjectResourceService;
    public $ProjectGrapher;
    public $ProjectService;
    public $ProjectFormValidator;
    public $UserAuthenticationService;
    public $CompanySettingService;

    public function __construct(ICompanyProjectService $companyProjectService,
        ICompanyProjectResourceService $companyProjectResourceService,
        IProjectGrapher $ProjectGrapher, IProjectService $ProjectService,
        IResourceFormValidator $projectFormValidator, IUserAuthenticationService $userAuthenticationService,
        ICompanySettingService $companySettingService
    ) {

        $this->middleware('auth');
        $this->CompanyProjectService         = $companyProjectService;
        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ProjectGrapher                = $ProjectGrapher;
        $this->ProjectService                = $ProjectService;
        $this->ProjectFormValidator          = $projectFormValidator;
        $this->UserAuthenticationService     = $userAuthenticationService;
        $this->CompanySettingService         = $companySettingService;
    }

    public function index()
    {

        $companyprojects = $this->CompanyProjectService->getAllCompanyProjects();

        return view('companyprojects.index', [
            'companyprojects' => $companyprojects,
        ]);

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
        $isManager = false;
        $isManager = $this->UserAuthenticationService->isManager();
        if ($isManager) {
            $companyProjectId = $this->CompanyProjectService->saveCompanyProject($request);
            return response()->json(
                [
                    'projectId' => $companyProjectId,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyProjectId)
    {

        $isManager = false;
        $isManager = $this->UserAuthenticationService->isManager();
        $isAdmin   = $this->UserAuthenticationService->isAdmin();
        $project   = $this->CompanyProjectService->getCompanyProject($companyProjectId);

        if (isset($project)) {

            $isRequestedCompanyProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($project->company_id);
            if (($isManager || $isAdmin) && $isRequestedCompanyProjectBelongsToSameCompany) {
                list($currentProjectResources) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);

                $companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

                $projectTimeLines = $this->ProjectGrapher->setupProjectCost($companyProject, $currentProjectResources, true);

                $projectTotalCost = $this->ProjectGrapher->calculateProjectTotalCost($projectTimeLines);
                $resourcesDetails = $this->ProjectGrapher->getResourcesTotalCostForProject($companyProject, $currentProjectResources, $projectTotalCost);

                $companyProject->cost              = $projectTotalCost;
                $isOnBudget                        = $this->ProjectService->isProjectOnBudget($projectTotalCost, $companyProject->budget);
                $companyProject->isProjectOnBudget = $isOnBudget;
                $currencyName                      = $this->CompanySettingService->getCurrencyName($project->company_id);
                $currencySymbol                    = $this->CompanySettingService->getCurrencySymbol($project->company_id);

                return view('companyProjects/viewCompanyProject',
                    [
                        'project'          => $companyProject,
                        'projectResources' => $currentProjectResources,
                        'companyProjectId' => $companyProjectId,
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyProjectId)
    {

        $isManager = $this->UserAuthenticationService->isManager();
        $isAdmin   = $this->UserAuthenticationService->isAdmin();
        $project   = $this->CompanyProjectService->getCompanyProject($companyProjectId);

        if (isset($project)) {

            $isRequestedCompanyProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($project->company_id);
            if (($isManager || $isAdmin) && $isRequestedCompanyProjectBelongsToSameCompany) {
                return view('companyProjects/companyProjectEditForm', ['companyproject' => $project]);
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
    public function update(Request $request, CompanyProject $companyproject)
    {
        $isManager = false;
        $isManager = $this->UserAuthenticationService->isManager();
        if ($isManager) {
            $this->CompanyProjectService->updateCompanyProject($request, $companyproject);
            return response()->json(
                [
                    'projectId' => $companyproject->id,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProject $companyproject)
    {

        $isManager = false;
        $isManager = $this->UserAuthenticationService->isManager();
        $isAdmin   = $this->UserAuthenticationService->isAdmin();
        if ($isManager || $isAdmin) {

            $this->CompanyProjectService->deleteCompanyProject($companyproject);

            return redirect('/companies/' . $companyproject->company_id);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    public function manageProject($companyid)
    {

        $isManager                                     = false;
        $isManager                                     = $this->UserAuthenticationService->isManager();
        $isAdmin                                       = $this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyProjectBelongsToSameCompany = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyid);
        if (($isManager || $isAdmin) && $isRequestedCompanyProjectBelongsToSameCompany) {

            return view('companyprojects.index',
                [
                    'companyid' => $companyid,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

}
