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
    public function showAllProjectsReport(Request $request,$companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        $projectsTimelines = $this->ReportService->getInternalProjectsTimeLines($companyId, $request->startDate, $request->endDate);

        $startAndEndDateTimelines = $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);

        $startAndEndDateTimelinesWithCost = $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines, null);

        $startAndEndDateTimelinesWithCostAndProfit = $this->ReportService->getMonthlyProfit($startAndEndDateTimelinesWithCost, $projectsTimelines);
       

        // $clientProjectsTimeLines = $this->ReportService->getClientProjectsTimeLines($companyId);
         return view
            ('reports/allProjectsGraphs/showProjectsGraphs',
            [
                'projectsTimelines'        => $projectsTimelines,

                'startAndEndDateTimelines' => $startAndEndDateTimelinesWithCostAndProfit,

            ]);
    }
    public function showInternalProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        $projectsTimelines = $this->ReportService->getInternalProjectsTimeLines($companyId, $request->startDate, $request->endDate);

        $startAndEndDateTimelines = $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);

        $startAndEndDateTimelinesWithCost = $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines, null);

        $startAndEndDateTimelinesWithCostAndProfit = $this->ReportService->getMonthlyProfit($startAndEndDateTimelinesWithCost, $projectsTimelines);

        return view
            ('reports/showProjectsGraphs',
            [
                'projectsTimelines'        => $projectsTimelines,

                'startAndEndDateTimelines' => $startAndEndDateTimelinesWithCostAndProfit,

            ]);
    }

    public function showClientProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        $projectsTimelines                         = $this->ReportService->getClientProjectsTimelines($companyId, $request->startDate, $request->endDate);
        $startAndEndDateTimelines                  = $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);
        $startAndEndDateTimelinesWithCost          = $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines, null);
        $startAndEndDateTimelinesWithCostAndProfit = $this->ReportService->getMonthlyProfit($startAndEndDateTimelinesWithCost, $projectsTimelines);
        // dd($startAndEndDateTimelinesWithCostAndProfit);

        return view
            ('reports/showProjectsGraphs',
            [
                'projectsTimelines'        => $projectsTimelines,
                'startAndEndDateTimelines' => $startAndEndDateTimelinesWithCostAndProfit,

            ]);
    }

}
