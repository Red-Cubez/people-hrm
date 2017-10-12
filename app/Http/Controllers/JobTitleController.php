<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IJobTitleService;
use People\Services\Interfaces\IResourceFormValidator;
use People\Services\StandardPermissions;

class JobTitleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $JobTitleService;
    public $ResourceFormValidator;

    public function __construct(IJobTitleService $jobTitleService, IResourceFormValidator $resourceFormValidator)
    {
        $this->middleware('auth');

        $this->middleware('permission:' . StandardPermissions::createEditDeleteJobTitle);

        $this->JobTitleService       = $jobTitleService;
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
    public function store(Request $request)
    {
        $isFormValid = $this->ResourceFormValidator->validateJobTitleForm($request->name);

        if ($isFormValid) {
            $jobTitle = $this->JobTitleService->saveJobTitle($request);

            return response()->json(
                [
                    'jobTitle'    => $jobTitle->title,
                    'jobTitleId'  => $jobTitle->id,
                    'isFormValid' => $isFormValid,
                ]);
        }
        if (!$isFormValid) {
            return response()->json(
                [

                    'isFormValid' => $isFormValid,
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyId)
    {

        $jobTitles = $this->JobTitleService->getJobTitlesOfCompany($companyId);

        return view('jobTitles/index',
            ['companyId' => $companyId,
                'jobTitles'  => $jobTitles,

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
        $jobTitle = $this->JobTitleService->getJobTitleDetails($jobTitleId);

        return view('jobTitles/updateJobTitleForm',
            ['jobTitle' => $jobTitle,

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
        $isFormValid = $this->ResourceFormValidator->validateJobTitleForm($request->name);

        if ($isFormValid) {
            $jobTitle = $this->JobTitleService->updateJobTitle($request, $jobTitleid);

            return response()->json(
                [
                    'jobTitle'    => $request->name,
                    'jobTitleId'  => $jobTitle->id,
                    'isFormValid' => $isFormValid,

                ]);

        }
        if (!$isFormValid) {
            return response()->json(
                [

                    'isFormValid' => $isFormValid,
                ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($jobTitleId)
    {

        $this->JobTitleService->deleteJobTitle($jobTitleId);
        return back();
        // return response()->json(['jobTitleId' => $jobTitleId]);

    }
}
