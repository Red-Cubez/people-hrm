<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IDateTimeService;
use People\Services\Interfaces\IReportService;
use People\Services\Interfaces\IUserAuthenticationService;

class ReportsController extends Controller
{
    public $ReportService;
    public $UserAuthenticationService;
    public $DateTimeService;

    public function __construct(IReportService $reportService, IUserAuthenticationService $userAuthenticationService,
        IDateTimeService $dateTimeService) {

        $this->middleware('auth');

        $this->ReportService             = $reportService;
        $this->UserAuthenticationService = $userAuthenticationService;
        $this->DateTimeService           = $dateTimeService;

    }

    public function showOptions($companyId)
    {
        $isManager                           = $this->UserAuthenticationService->isManager();
        $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if (($isManager || $isAdmin) && $isRequestedCompanyBelongsToEmployee) {

            return view
                ('reports/index',
                [
                    'companyId' => $companyId,
                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }
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

        $internalProjectsStartAndEndDateTimelinesWithCostAndProfit         = $this->ReportService->getMonthlyProfit($internalProjectsStartAndEndDateTimelinesWithCost, $internalProjectsTimelines);
        $internalProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->getTotalRevenue($internalProjectsStartAndEndDateTimelinesWithCost, $internalProjectsTimelines);

        //client projects

        $clientProjectsTimelines                                         = $this->ReportService->getClientProjectsTimelines($companyId, $request->startDate, $request->endDate);
        $clientProjectsStartAndEndDateTimelines                          = $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);
        $clientProjectsStartAndEndDateTimelinesWithCost                  = $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($clientProjectsStartAndEndDateTimelines, $clientProjectsTimelines, null);
        $clientProjectsStartAndEndDateTimelinesWithCostAndProfit         = $this->ReportService->getMonthlyProfit($clientProjectsStartAndEndDateTimelinesWithCost, $clientProjectsTimelines);
        $clientProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->getTotalRevenue($clientProjectsStartAndEndDateTimelinesWithCostAndProfit, $clientProjectsTimelines);

//dd($internalProjectsStartAndEndDateTimelinesWithCostAndProfit);
        // $clientProjectsTimeLines = $this->ReportService->getClientProjectsTimeLines($companyId);
        return view
            ('reports/allProjectsGraphs/showProjectsGraphs',
            [
                'internalProjectsTimelines'                => $internalProjectsTimelines,

                'internalProjectsStartAndEndDateTimelines' => $internalProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal,
                'clientProjectsTimelines'                  => $clientProjectsTimelines,
                'clientProjectsStartAndEndDateTimelines'   => $clientProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal,
                'isAllProjectsGraphs'                      => true,

            ]);
    }
    public function showInternalProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        // $projectsTimelines =
        // $this->ReportService->getInternalProjectsTimeLines($companyId, $request->startDate, $request->endDate);

        // $startAndEndDateTimelines =
        // $this->ReportService->getStartAndEndDateTimelines($request->startDate, $request->endDate);

        //////

        list($startDate, $endDate) = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);

        $startAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyId);

        //////

        // $startAndEndDateTimelinesWithCost =
        // $this->ReportService->mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines, null);

        // $startAndEndDateTimelinesWithCostAndProfit =
        // $this->ReportService->getMonthlyProfit($startAndEndDateTimelinesWithCost, $projectsTimelines);

        // $startAndEndDateTimelinesWithCostProfitAndNetTotal =
        // $this->ReportService->getTotalRevenue($startAndEndDateTimelinesWithCostAndProfit, $projectsTimelines);

        // return view
        //     ('reports/showProjectsGraphs',
        //     [
        //         'projectsTimelines'        => $projectsTimelines,

        //         'startAndEndDateTimelines' => $startAndEndDateTimelinesWithCostProfitAndNetTotal,

        //     ]);
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

        $startAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->getTotalRevenue($startAndEndDateTimelinesWithCostAndProfit, $projectsTimelines);
        // dd($startAndEndDateTimelinesWithCostAndProfit);

        return view
            ('reports/showProjectsGraphs',
            [
                'projectsTimelines'        => $projectsTimelines,
                'startAndEndDateTimelines' => $startAndEndDateTimelinesWithCostProfitAndNetTotal,

            ]);
    }

}
