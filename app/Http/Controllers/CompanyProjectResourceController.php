<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProjectResource;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\IResourceFormValidator;

class CompanyProjectResourceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $CompanyProjectResourceService;
    public $ResourceFormValidator;

    public function __construct(ICompanyProjectResourceService $companyProjectResourceService,
                                IResourceFormValidator $resourceFormValidator)
    {

        $this->CompanyProjectResourceService = $companyProjectResourceService;
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
    public function validateResourceForm(Request $request)
    {
        $formErrors = $this->ResourceFormValidator->validateForm($request);

        return response()->json(
            [
                'formErrors' => $formErrors,
            ]);

    }

    public function store(Request $request)
    {
        $this->CompanyProjectResourceService->saveOrUpdateCompanyProjectResource($request);
        return response()->json(
            [
                'projectId' =>  $request->companyProjectId,
            ]);

//        return redirect('/companyprojects/'. $request->companyProjectId);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($companyProjectId)
    {

        list($currentProjectResources, $availableEmployees) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);
        return view('CompanyProjectResources.index', [
            'projectResources' => $currentProjectResources,
            'availableEmployees' => $availableEmployees,
            'companyProjectId' => $companyProjectId,

        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($companyProjectId)
    {

        $resource = $this->CompanyProjectResourceService->showEditForm($companyProjectId);

        return view('CompanyProjectResources.updateResource', [
            'projectresources' => $resource,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public
    function destroy(CompanyProjectResource $companyprojectresource, Request $request)
    {

        $this->CompanyProjectResourceService->deleteCompanyProjectResource($companyprojectresource);

        return redirect('/companyprojects/' . $request->companyProjectId);
    }

}
