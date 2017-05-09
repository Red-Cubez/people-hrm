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
        //
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
