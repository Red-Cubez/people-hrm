<?php

namespace People\Http\Controllers;

use People\Models\ProjectResource;
use People\Models\Employee;
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

     

      

        // //TODO need to perform eagar loaging in this context
        // //TODO only get project resources for a particular client
        // $currentProjectResources = ProjectResource::orderBy('created_at', 'asc')->get();

        // //TODO get resources based on availibility
        // $availableEmployees = Employee::orderBy('created_at', 'asc')->get();


        // return view('projectResources.index', [
        //     'projectResources' => $currentProjectResources,
        //     'availableEmployees' => $availableEmployees
        // ]);
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
        // dd($request->clientProjectid);
       // dd($request->clientProjectid);
      
        

            
      
        
        if(!isset($request->projectResource))
        {

         $projectResource = new ProjectResource();
         
        }

        / if(isset($request->projectResource))
        // {
        //  dd($request->projectResource);
        //  $projectResource = $request->projectResource;
         
         }
       //  //TODO get the relative project id
       // // $projectResource->client_project_id = 1;
       
        if(isset($request->title))
           {
    
            $projectResource->title = $request->title;
            $projectResource->client_project_id = $request->clientProjectid;

            $projectResource->expectedStartDate = $request->expectedStartDate;
            $projectResource->expectedEndDate = $request->expectedEndDate;
            $projectResource->actualStartDate = $request->actualStartDate;
            $projectResource->actualEndDate = $request->actualEndDate;
            $projectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $projectResource->hoursPerWeek = $request->hoursPerWeek;
             $projectResource->save();
            return redirect('/clientprojects/'.$request->clientProjectid.'/projectresources');
           }
       //  //TODO set other properties as well for the resource
           
        
      else if(isset($request->employee_id))
          { 
        //dd($request->employee_id);

           $projectResource->employee_id = $request->employee_id;
           $projectResource->client_project_id=$request->clientProjectid;
       //  //TODO set other properties as well for the resource
           $projectResource->save();
           return redirect('/clientprojects/'.$request->clientProjectid.'/projectresources');
          }
    }


 public function manageressources($clientProjectid)
    { 
        
        //TODO get resources based on availibility
       
        $currentProjectResources = ProjectResource::where('client_project_id',$clientProjectid)->orderBy('created_at', 'asc')->get();
      // dd( $currenProjectResources);
        $availableEmployees = Employee::orderBy('created_at', 'asc')->get();

        

        return view('projectResources.index', [
            'projectResources' => $currentProjectResources,
            'availableEmployees' => $availableEmployees,
            'clientProjectid'=> $clientProjectid
                    ]);


    }
    /**
     * Display the specified resource.
     *
     * @param  \People\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectResource $projectresource)
    {
        //dd('show method');
        //dd($projectresource);
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
    public function update(Request $request, ProjectResource $projectresource)
    {
        dd("$projectresource");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\ProjectResource  $projectresource
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectResource $projectresource)
    {
        //dd($projectresource);
        $projectresource->delete();
        return redirect('/clientprojects/'.$projectresource->client_project_id.'/projectresources');
    }

    
 public function updateressources($projectResourceid)
    { 
        // dd($projectResource);
        //TODO get resources based on availibility
       $Resource = ProjectResource::where('id',$projectResourceid)->orderBy('created_at', 'asc')->get();
        // $currentProjectResources = ProjectResource::where('client_project_id',$clientProjectid)->orderBy('created_at', 'asc')->get();
         //dd( $projectResource);

         // $availableEmployees = Employee::orderBy('created_at', 'asc')->get();

        
         return view('projectResources.updateResource',[
            'projectresources'=>$Resource

            ]);


       // return view('projectResources.index', [
       // 'projectResources' => $currentProjectResources,
       //      'availableEmployees' => $availableEmployees,
       //    'clientProjectid'=> $clientProjectid
       //             ]);

    
    }





}

