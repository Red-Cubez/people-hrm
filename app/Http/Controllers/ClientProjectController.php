<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\ClientProject;
use People\Services\Interfaces\IClientProjectService;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $ClientProjectService;

    public function __construct(IClientProjectService $clientProjectService)
    {

        $this->ClientProjectService = $clientProjectService;
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
    public function store(Request $request)
    {

        $clientProject = $this->ClientProjectService->createClientProject($request);

        return redirect('/clients/' . $clientProject->client_id);
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

        return view('clientProjects/viewClientProject', ['project' => $clientProjectModel]);

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

        return redirect('/clientprojects/' . $clientproject->id);

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
