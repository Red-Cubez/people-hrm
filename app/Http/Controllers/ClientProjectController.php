<?php

namespace People\Http\Controllers;

use People\Models\ClientProject;
use People\Models\Client;
use Illuminate\Http\Request;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO only get projects for a particular client
        $clientProjects = ClientProject::orderBy('created_at', 'asc')->get();

        return view('clientprojects.index', ['clientProjects' => $clientProjects ]);
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
        // dd($request);
        $clientProject = new ClientProject();
        $clientProject->name = $request->name;
        $clientProject->expectedStartDate = $request->expectedStartDate;
        $clientProject->expectedEndDate = $request->expectedEndDate;
        $clientProject->actualStartDate = $request->actualStartDate;
        $clientProject->actualEndDate = $request->actualEndDate;
        $clientProject->budget = $request->budget;
        $clientProject->cost = $request->cost;
        //TODO These properties need to be set from fields
        //TODO this value needs to come from the correct client
    //    $client = Client::find('$clientid');
         // dd($client->id);
        $clientProject->client_id = $request->clientid;
        $clientProject->save();

//dd($clientProject);
        return redirect('/clients/'.$clientProject->client_id.'/clientprojects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function show(ClientProject $clientProject)
    {
      // return view('clientprojects.index',[ 'clientProject' =>$clientProject ]);
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
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\ClientProject  $clientproject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientProject $clientproject)
    {
        // dd($clientproject);
        $clientid = $clientproject->client_id;
        $clientproject->delete();
        return redirect('/clients/'.$clientid.'/clientprojects');
    }


 public function manageProject($clientid)
    {
        $clientProjects = ClientProject::where('client_id', $clientid)->orderBy('created_at', 'asc')->get();
        return view('clientprojects.index', 
            ['clientProjects' => $clientProjects,
            'clientid' => $clientid
             ]);
    }
}
