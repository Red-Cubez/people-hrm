<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProjectResource;
use People\Models\CompanyProject;
use People\Models\Employee;

class CompanyProjectResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->employee_id);
         
        if (!isset($request->projectResourceId)) {

            $CompanyProjectResource = new CompanyProjectResource();

        }

        if (isset($request->projectResourceId)) {

            $CompanyProjectResource = CompanyProjectResource::find($request->projectResourceId);

        }
        //  //TODO get the relative project id

        // if ( (isset($request->employee_id)) || (isset($request->title))) {
        if ( isset($request->projectResourceId)) {
            //dd("update");
           ;
            $CompanyProjectResource->title = $request->title;
           // $CompanyProjectResource->company_project_id = $request->companyProjectId;
            $CompanyProjectResource->expectedStartDate = $request->expectedStartDate;
            $CompanyProjectResource->expectedEndDate = $request->expectedEndDate;
            $CompanyProjectResource->actualStartDate = $request->actualStartDate;
            $CompanyProjectResource->actualEndDate = $request->actualEndDate;
            $CompanyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $CompanyProjectResource->hoursPerWeek = $request->hoursPerWeek;

            $CompanyProjectResource->save();
           // dd($request);
            return redirect('/companyprojectresources/' . $request->companyProjectId );
        }
        //  //TODO set other properties as well for the resource

         elseif (!isset($request->projectResourceId)) {
           // dd("save");
            $CompanyProjectResource->title = $request->title;
            $CompanyProjectResource->expectedStartDate = $request->expectedStartDate;
            $CompanyProjectResource->expectedEndDate = $request->expectedEndDate;
            $CompanyProjectResource->actualStartDate = $request->actualStartDate;
            $CompanyProjectResource->actualEndDate = $request->actualEndDate;
            $CompanyProjectResource->hourlyBillingRate = $request->hourlyBillingRate;
            $CompanyProjectResource->hoursPerWeek = $request->hoursPerWeek;
            $CompanyProjectResource->employee_id = $request->employee_id;
            $CompanyProjectResource->company_project_id = $request->companyProjectId;
            //TODO set other properties as well for the resource

            $CompanyProjectResource->save();

            return redirect('/companyprojectresources/' . $request->companyProjectId );
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyProjectId)
    {
        $currentProjectResources = CompanyProjectResource::where('company_project_id', $companyProjectId)->orderBy('created_at', 'asc')
            ->get();
          //  dd($currentProjectResources);
      //  dd($currentProjectResources);

        $availableEmployees = Employee::orderBy('created_at', 'asc')->get();
        return view('CompanyProjectResources.index', [
             'projectResources' => $currentProjectResources,
             'availableEmployees' => $availableEmployees,
             'companyProjectId' => $companyProjectId

         ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyProjectId)
    {
        
        $Resource = CompanyProjectResource::where('id', $companyProjectId)->orderBy('created_at', 'asc')->get();

        return view('CompanyProjectResources.updateResource', [
            'projectresources' => $Resource
            ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProjectResource $companyprojectresource,Request $request)
    {    
        $companyprojectresource->delete();
        //dd($request);
        return redirect('/companyprojectresources/'.$request->companyProjectId);
    }
    
}
