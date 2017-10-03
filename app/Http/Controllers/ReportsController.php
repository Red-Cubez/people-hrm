<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\IDateTimeService;
use People\Services\Interfaces\IReportService;
use People\Services\Interfaces\IUserAuthenticationService;

class ReportsController extends Controller
{
    public $ReportService;
    public $UserAuthenticationService;
    public $DateTimeService;
    public $CompanyProjectService;
    public $ClientProjectService;

    public function __construct(IReportService $reportService, IUserAuthenticationService $userAuthenticationService,
        IDateTimeService $dateTimeService, ICompanyProjectService $companyProjectService, IClientProjectService $clientProjectService) {

        $this->middleware('auth');

        $this->ReportService             = $reportService;
        $this->UserAuthenticationService = $userAuthenticationService;
        $this->DateTimeService           = $dateTimeService;
        $this->CompanyProjectService     = $companyProjectService;
        $this->ClientProjectService      = $clientProjectService;

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
        list($startDate, $endDate)                         = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);
        $companyInternalProjects                           = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);
        $internalProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyInternalProjects);

        $internalProjectsmonthlyTimelines = $this->ReportService->setUpMontlhyTimelines($internalProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal);

        //client projects

        list($startDate, $endDate)                         = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);
        $companyClientProjects                             = $this->ClientProjectService->getAllClientProjectsOfCompany($companyId);
        $clientProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyClientProjects);

        $clientProjectsmonthlyTimelines = $this->ReportService->setUpMontlhyTimelines($clientProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal);
        return view
            ('reports/allProjectsGraphs/showProjectsGraphs',
            [
                'internalProjectsmonthlyTimelines' => $internalProjectsmonthlyTimelines,

                'clientProjectsmonthlyTimelines'   => $clientProjectsmonthlyTimelines,

                'isAllProjectsGraphs'              => true,

            ]);

    }

    public function showInternalProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        list($startDate, $endDate)                         = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);
        $companyInternalProjects                           = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);
        $startAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyInternalProjects);

        $monthlyTimelines = $this->ReportService->setUpMontlhyTimelines($startAndEndDateTimelinesWithCostProfitAndNetTotal);

        return view
            ('reports/showProjectsGraphs',
            [
                //'projectsTimelines'        => $projectsTimelines,

                'monthlyTimelines' => $monthlyTimelines,

            ]);
    }

    public function showClientProjectsReport(Request $request, $companyId)
    {
        $this->validate($request, [
            'startDate' => 'required|date|before:endDate',

            'endDate'   => 'required|date|after:startDate',
        ]);

        list($startDate, $endDate)                         = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);
        $companyClientProjects                             = $this->ClientProjectService->getAllClientProjectsOfCompany($companyId);
        $startAndEndDateTimelinesWithCostProfitAndNetTotal =
        $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyClientProjects);

        $monthlyTimelines = $this->ReportService->setUpMontlhyTimelines($startAndEndDateTimelinesWithCostProfitAndNetTotal);

        return view
            ('reports/showProjectsGraphs',
            [
                //'projectsTimelines'        => $projectsTimelines,

                'monthlyTimelines' => $monthlyTimelines,

            ]);
    }

}
