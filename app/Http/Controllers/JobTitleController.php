<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\JobTitle;
use People\Services\Interfaces\IJobTitleService;

class JobTitleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $JobTitleService;

    public function __construct(IJobTitleService $jobTitleService) {

        $this->JobTitleService = $jobTitleService;
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
        //dd($request);
        $this->JobTitleService->saveJobTitle($request);

       // dd("save");
        return redirect('/jobtitle/'.$request->companyId);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyId)
    {

        $jobTitles=$this->JobTitleService->getJobTitlesOfCompany($companyId);

        return view('jobTitles/index',
            ['companyId' => $companyId,
                'jobTitles' =>$jobTitles,

            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($jobTitleId)
    {
        $jobTitle=$this->JobTitleService->getJobTitleDetails($jobTitleId);

        return view('jobTitles/updateJobTitleForm',
            ['jobTitle' =>$jobTitle,

            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jobTitleid)
    {

        $this->JobTitleService->updateJobTitle($request,$jobTitleid);

        return redirect('/jobtitle/'.$request->companyId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($jobTitleId)
    {
       $companyId= $this->JobTitleService->deleteJobTitle($jobTitleId);
       // dd("deleted");
        return redirect('/jobtitle/'.$companyId);

    }
}
