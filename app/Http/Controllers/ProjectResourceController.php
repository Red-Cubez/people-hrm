<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\ProjectResource;
use People\Services\Interfaces\IProjectResourceService;
use People\Services\Interfaces\IProjectService;
use People\Services\Interfaces\IResourceFormValidator;


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

    public function __construct(IProjectResourceService $projectResourceService, IProjectService $projectService,
                                IResourceFormValidator $resourceFormValidator)
    {

        $this->ProjectResourceService = $projectResourceService;
        $this->ProjectService = $projectService;
        $this->ResourceFormValidator = $resourceFormValidator;
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
    public function store(Request $request)
    {
        /////////////
        ///
        ///
        ///
        ///
        ///
        ///
        ///
        /// ///////////
        $formErrors = $this->ResourceFormValidator->validateForm($request);

        if ($formErrors->hasErrors) {
            list($currentProjectResources, $availableEmployees) = $this->ProjectResourceService->showClientProjectResources($request->clientProjectid);

            $projectResources = $this->ProjectService->mapResourcesDetailsToClass($currentProjectResources, false);

            return view('projectResources.index', [
                'projectResources' => $projectResources,
                'availableEmployees' => $availableEmployees,
                'clientProjectid' => $request->clientProjectid,
                'formErrors' => $formErrors,
            ]);
        } else {
            $this->ProjectResourceService->saveOrUpdateProjectResource($request);

            return redirect('/clientprojects/' . $request->clientProjectid . '/projectresources');
        }

    }

    public function manageressources($clientProjectId)
    {

        list($currentProjectResources, $availableEmployees) = $this->ProjectResourceService->showClientProjectResources($clientProjectId);

        $projectResources = $this->ProjectService->mapResourcesDetailsToClass($currentProjectResources, false);

        return view('projectResources.index', [
            'projectResources' => $projectResources,
            'availableEmployees' => $availableEmployees,
            'clientProjectid' => $clientProjectId,
        ]);

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

    public function updateressources($projectResourceid)
    {
        $Resource = $this->ProjectResourceService->updateProjectRessources($projectResourceid);

        return view('projectResources.updateResource', [
            'projectresources' => $Resource

        ]);
    }

}
