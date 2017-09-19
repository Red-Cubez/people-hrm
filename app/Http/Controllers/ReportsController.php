<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IReportService;

class ReportsController extends Controller
{
    public $ReportService;

    public function __construct(IReportService $reportService)
    {

        $this->middleware('auth');

        $this->ReportService = $reportService;

    }

    public function showOptions($companyId)
    {
        return view
            ('reports/index',
            [
                'companyId' => $companyId,
            ]);
    }
    public function showAllProjectsReport($companyId)
    {

        $internalProjectsTimeLines = $this->ReportService->getInternalProjectsTimeLines($companyId);

        $clientProjectsTimeLines = $this->ReportService->getClientProjectsTimeLines($companyId);

    }
    public function showInternalProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        $projectsTimelines = $this->ReportService->getInternalProjectsTimeLines($companyId,$request->startDate,$request->endDate);
        
        return view
            ('reports/internalProjectsGraphs/showProjectsGraphs',
            [
                'projectsTimelines' => $projectsTimelines,
            ]);
    }
    public function showClientProjectsReport($companyId)
    {
        $projectsTimeLines = $this->ReportService->getClientProjectsTimeLines($companyId);
        dd($projectsTimeLines);
    }

}
