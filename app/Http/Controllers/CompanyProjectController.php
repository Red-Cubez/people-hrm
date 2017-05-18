<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\CompanyProject;
use People\Services\Interfaces\ICompanyProjectService;

class CompanyProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $CompanyProjectService;

    public function __construct(ICompanyProjectService $companyProjectService)
    {

        $this->CompanyProjectService = $companyProjectService;
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

        $this->CompanyProjectService->saveCompanyProject($request);

        return redirect('/companies/' . $request->companyid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyProject $companyproject)
    {

        return view('companyProjects/companyProjectEditForm', ['companyproject' => $companyproject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyProjectId)
    {

        $companyProject = $this->CompanyProjectService->viewCompanyProject($companyProjectId);

        return view('companyProjects/viewCompanyProject', ['project' => $companyProject]);

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
        //
        $this->CompanyProjectService->updateCompanyProject($request, $companyproject);

        return redirect('/companies/' . $companyproject->company_id);
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
