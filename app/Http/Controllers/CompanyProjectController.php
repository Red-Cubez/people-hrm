<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProject;
use People\Services\Interfaces\ICompanyProjectResourceService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IProjectGrapher;

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

    public function __construct(ICompanyProjectService $companyProjectService,
                                ICompanyProjectResourceService $companyProjectResourceService,
                                IProjectGrapher $ProjectGrapher)
    {

        $this->CompanyProjectService = $companyProjectService;
        $this->CompanyProjectResourceService = $companyProjectResourceService;
        $this->ProjectGrapher = $ProjectGrapher;
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
    public function store(Request $request)
    {

        $companyProjectId = $this->CompanyProjectService->saveCompanyProject($request);

        return redirect('/companyprojects/' . $companyProjectId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyProjectId)
    {

        list($currentProjectResources, $availableEmployees) = $this->CompanyProjectResourceService->showCompanyProjectResources($companyProjectId);

        $companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);
      //  dd($companyProject);
        $this->ProjectGrapher->setupProjectCost($companyProject,$currentProjectResources,true);

        return view('companyProjects/viewCompanyProject',
            [
                'project' => $companyProject,
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
    public function edit(CompanyProject $companyproject)
    {
        return view('companyProjects/companyProjectEditForm', ['companyproject' => $companyproject]);
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
        $this->CompanyProjectService->updateCompanyProject($request, $companyproject);

        return redirect('/companyprojects/' . $companyproject->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProject $companyproject)
    {

        $this->CompanyProjectService->deleteCompanyProject($companyproject);

        return redirect('/companies/' . $companyproject->company_id);
    }

    public function manageProject($companyid)
    {

        $companyProjects = $this->CompanyProjectService->manageProject($companyid);

        return view('companyprojects.index', ['companyProjects' => $companyProjects, 'companyid' => $companyid]);
    }

}
