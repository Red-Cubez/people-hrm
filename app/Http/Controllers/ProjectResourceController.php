<?php

namespace People\Http\Controllers;

use People\Models\ProjectResource;
use People\Models\ClientProject;
use People\Models\Client;
use Illuminate\Http\Request;

class ProjectResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO only get projects for a particular client
        $projectResources = ProjectResource::orderBy('created_at', 'asc')->get();

        return view('projectResources.index', [
            'projectResources' => $projectResources
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectResource = new ProjectResource();
        $projectResource->name = $request->name;

        //TODO These properties need to be set from fields
        //TODO this value needs to come from the correct client
        $client = Client::find(1);
//        dd($client);
        $projectResource->client_id = $client->id;
        $projectResource->save();

        return redirect('/projectresources');
    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function show(ClientProject $clientProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientProject $clientProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \People\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientProject $clientProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectResource $projectResource)
    {
        $projectResource->delete();
        return redirect('/projectResources');
    }
}
