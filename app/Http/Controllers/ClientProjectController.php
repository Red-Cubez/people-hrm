<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\ClientProject;
use People\Models\ProjectResource;
use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\IProjectGrapher;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IResourceFormValidator;

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
    public function __construct(IClientProjectService $clientProjectService,IProjectGrapher $projectGrapher,
                                IProjectService $projectService,IProjectResourceService $projectResourceService,
                                IResourceFormValidator $projectFormValidator)
    {

        $this->ClientProjectService = $clientProjectService;
        $this->ProjectGrapher = $projectGrapher;
        $this->ProjectService =$projectService;
        $this->ProjectResourceService =$projectResourceService;
        $this->ProjectFormValidator = $projectFormValidator;
    }

    public function index(Request $request)
    {


        $clientProjects = $this->ClientProjectService->getClientProjects();

        return view('clientprojects.index',
            [
                'clientProjects' => $clientProjects,
                'companyId' => $request->companyId,
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
                'action'=> $request->action,
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

        $clientProjectModel = $this->ClientProjectService->viewClientProject($clientProjectId);
        $clientProjects=$this->ClientProjectService->getClientProjectDetails($clientProjectId);

//        $currentProjectResources = ProjectResource::where('client_project_id', $clientProjectId)->orderBy('created_at', 'asc')
//            ->get();
        list($currentProjectResources,$availableEmployees)=$this->ProjectResourceService->showClientProjectResources($clientProjectId);


        $projectResources=$this->ProjectService->mapResourcesDetailsToClass($currentProjectResources,false);
        $projectTimeLines = $this->ProjectGrapher->setupProjectCost($clientProjectModel, $projectResources, false);


        $projectTotalCost = $this->ProjectGrapher->calculateProjectTotalCost($projectTimeLines);
        $resourcesDetails = $this->ProjectGrapher->getResourcesTotalCostForProject($clientProjectModel, $projectResources,$projectTotalCost);

        $clientProjectModel->cost = $projectTotalCost;
        $isOnBudget=$this->ProjectService->isProjectOnBudget($projectTotalCost, $clientProjectModel->budget);
        $clientProjectModel->isProjectOnBudget=$isOnBudget;

        return view('clientProjects/viewClientProject',
            [
                'project' => $clientProjectModel,
                'projectTimeLines' => $projectTimeLines,
                'resourcesDetails' => $resourcesDetails,
                'projectTotalCost' => $projectTotalCost,
                //'clientProjects'=>$clientProjects,

            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\ClientProject $clientProject
     * @return \Illuminate\Http\Response
     */
    public function edit($clientProjectId)
    {


        $clientProject = $this->ClientProjectService->getClientProjectDetails($clientProjectId);
        return view('clientProjects/clientProjectEditForm', ['clientProject' => $clientProject]);
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

//        return response()->json(
//            [
//                'projectId' => $clientProject->clientproject->id,
//            ]);
        //return redirect('/clientprojects/' . $clientproject->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\ClientProject $clientproject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientProject $clientproject)
    {
        $clientid = $this->ClientProjectService->deleteClientProject($clientproject);

        return redirect('/clients/' . $clientid);
    }

    public function manageProject($clientId)
    {
        $clientProjects = $this->ClientProjectService->manageClientProjects($clientId);

        return view('clientprojects.index',
            ['clientProjects' => $clientProjects,
                'clientId' => $clientId,
            ]);
    }
}
