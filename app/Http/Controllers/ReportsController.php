<?php

namespace People\Http\Controllers;

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
    public function showInternalProjectsReport($companyId)
    {
        $projectsTimeLines = $this->ReportService->getInternalProjectsTimeLines($companyId);
        dd($projectsTimeLines);
    }
    public function showClientProjectsReport($companyId)
    {
        $projectsTimeLines = $this->ReportService->getClientProjectsTimeLines($companyId);
        dd($projectsTimeLines);
    }

}
\