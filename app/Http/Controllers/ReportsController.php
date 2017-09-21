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
    public function showAllProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);
        //internal projects
        $internalProjectsTimelines = $this->ReportService->getInternalProjectsTimeLines($companyId, $request->startDate, $request->endDate);

        $internalProjectsStartAndEndDateTimelines = $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);

        $internalProjectsStartAndEndDateTimelinesWithCost = $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($internalProjectsStartAndEndDateTimelines, $internalProjectsTimelines, true);

        $internalProjectsStartAndEndDateTimelinesWithCostAndProfit = $this->ReportService->getMonthlyProfit($internalProjectsStartAndEndDateTimelinesWithCost, $internalProjectsTimelines);

        //client projects

        $clientProjectsTimelines                                 = $this->ReportService->getClientProjectsTimelines($companyId, $request->startDate, $request->endDate);
        $clientProjectsStartAndEndDateTimelines                  = $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);
        $clientProjectsStartAndEndDateTimelinesWithCost          = $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($clientProjectsStartAndEndDateTimelines, $clientProjectsTimelines, null);
        $clientProjectsStartAndEndDateTimelinesWithCostAndProfit = $this->ReportService->getMonthlyProfit($clientProjectsStartAndEndDateTimelinesWithCost, $clientProjectsTimelines);
//dd($internalProjectsStartAndEndDateTimelinesWithCostAndProfit);
        // $clientProjectsTimeLines = $this->ReportService->getClientProjectsTimeLines($companyId);
        return view
            ('reports/allProjectsGraphs/showProjectsGraphs',
            [
                'internalProjectsTimelines'                                 => $internalProjectsTimelines,

                'internalProjectsStartAndEndDateTimelinesWithCostAndProfit' => $internalProjectsStartAndEndDateTimelinesWithCostAndProfit,
                'clientProjectsTimelines'                                   => $clientProjectsTimelines,
                'clientProjectsStartAndEndDateTimelinesWithCostAndProfit'   => $clientProjectsStartAndEndDateTimelinesWithCostAndProfit,
                'isAllProjectsGraphs'                                       => true,

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
