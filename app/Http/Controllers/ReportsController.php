<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Services\Interfaces\IClientProjectService;
use People\Services\Interfaces\ICompanyProjectService;
use People\Services\Interfaces\ICompanySettingService;
use People\Services\Interfaces\IDateTimeService;
use People\Services\Interfaces\IReportService;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Services\StandardPermissions;
use People\Models\Employee;

class ReportsController extends Controller
{
    public $ReportService;
    public $UserAuthenticationService;
    public $DateTimeService;
    public $CompanyProjectService;
    public $ClientProjectService;
    public $CompanySettingService;

    public function __construct(IReportService $reportService, IUserAuthenticationService $userAuthenticationService,
        IDateTimeService $dateTimeService, ICompanyProjectService $companyProjectService, IClientProjectService $clientProjectService,
        ICompanySettingService $companySettingService) {

        $this->middleware('auth');

        $this->middleware('permission:' . StandardPermissions::showInternalProjectsReport .
            '|' . StandardPermissions::showClientProjectsReport .
            '|' . StandardPermissions::showAllProjectsReport .
            '|' . StandardPermissions::reportOptions, ['only' => ['showOptions']]);

        $this->middleware('permission:' . StandardPermissions::showInternalProjectsReport, ['only' => ['showInternalProjectsReport', 'generateReport']]);

        $this->middleware('permission:' . StandardPermissions::showClientProjectsReport, ['only' => ['showClientProjectsReport', 'generateReport']]);

        $this->middleware('permission:' . StandardPermissions::showAllProjectsReport, ['only' => ['showAllProjectsReport', 'generateReport']]);

        $this->ReportService             = $reportService;
        $this->UserAuthenticationService = $userAuthenticationService;
        $this->DateTimeService           = $dateTimeService;
        $this->CompanyProjectService     = $companyProjectService;
        $this->ClientProjectService      = $clientProjectService;
        $this->CompanySettingService     = $companySettingService;

    }

    public function showOptions($companyId)
    {
        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();
        // $isHrManager     = $this->UserAuthenticationService->isHrManager();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();

        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {

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

        list($startDate, $endDate) = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);

        $this->validate($request, [
            'startDate' => 'required|date',

            'endDate'   => 'required|date',
        ]);

        if (!$this->DateTimeService->validateStartAndEndDates($startDate, $endDate)) {
            $errosMessage = "End date can not be a date before start date";
            return back()->withErrors($errosMessage);

        }

        // $isManager = $this->UserAuthenticationService->isManager();
        // $isAdmin   = $this->UserAuthenticationService->isAdmin();

        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {

            $companyInternalProjects                                           = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);
            $internalProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal =
            $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyInternalProjects);

            $internalProjectsmonthlyTimelines = $this->ReportService->setUpMontlhyTimelines($internalProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal);

            list($startDate, $endDate)                                       = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);
            $companyClientProjects                                           = $this->ClientProjectService->getAllClientProjectsOfCompany($companyId);
            $clientProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal =
            $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyClientProjects);

            $clientProjectsmonthlyTimelines = $this->ReportService->setUpMontlhyTimelines($clientProjectsStartAndEndDateTimelinesWithCostProfitAndNetTotal);

            $currencyNameAndSymbol = $this->CompanySettingService->getCurrencyName($companyId) . ' ' . $this->CompanySettingService->getCurrencySymbol($companyId);

            return view
                ('reports/allProjectsGraphs/showProjectsGraphs',
                [
                    'internalProjectsmonthlyTimelines' => $internalProjectsmonthlyTimelines,
                    'clientProjectsmonthlyTimelines'   => $clientProjectsmonthlyTimelines,
                    'currencyNameAndSymbol'            => $currencyNameAndSymbol,
                    'isAllProjectsGraphs'              => true,
                    'companyId'                        => $companyId,

                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

        }

    }

    public function showInternalProjectsReport(Request $request, $companyId)
    {
        list($startDate, $endDate) = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);

        $this->validate($request, [
            'startDate' => 'required|date',

            'endDate'   => 'required|date',
        ]);

        if (!$this->DateTimeService->validateStartAndEndDates($startDate, $endDate)) {
            $errosMessage = "End date can not be a date before start date";
            return back()->withErrors($errosMessage);
        }

        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {

            $companyInternalProjects = $this->CompanyProjectService->getAllInternalProjectsOfCompany($companyId);

            $startAndEndDateTimelinesWithCostProfitAndNetTotal =
            $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyInternalProjects);

            $monthlyTimelines = $this->ReportService->setUpMontlhyTimelines($startAndEndDateTimelinesWithCostProfitAndNetTotal);

            $currencyNameAndSymbol = $this->CompanySettingService->getCurrencyName($companyId) . ' ' . $this->CompanySettingService->getCurrencySymbol($companyId);

            return view
                ('reports/showProjectsGraphs',
                [

                    'monthlyTimelines'      => $monthlyTimelines,
                    'currencyNameAndSymbol' => $currencyNameAndSymbol,
                    'companyId'             => $companyId,
                    'projectsType'          => "internalProjects",

                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    public function showClientProjectsReport(Request $request, $companyId)
    {
        list($startDate, $endDate) = $this->DateTimeService->getfirstAndLastDateOfGivenDate($request->startDate, $request->endDate);

        $this->validate($request, [
            'startDate' => 'required|date',

            'endDate'   => 'required|date',
        ]);

        if (!$this->DateTimeService->validateStartAndEndDates($startDate, $endDate)) {
            $errosMessage = "End date can not be a date before start date";
            return back()->withErrors($errosMessage);

        }

        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);

        if ($isRequestedCompanyBelongsToEmployee) {

            $companyClientProjects = $this->ClientProjectService->getAllClientProjectsOfCompany($companyId);

            $startAndEndDateTimelinesWithCostProfitAndNetTotal =
            $this->ReportService->startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyClientProjects);

            $monthlyTimelines = $this->ReportService->setUpMontlhyTimelines($startAndEndDateTimelinesWithCostProfitAndNetTotal);

            $currencyNameAndSymbol = $this->CompanySettingService->getCurrencyName($companyId) . ' ' . $this->CompanySettingService->getCurrencySymbol($companyId);

            return view
                ('reports/showProjectsGraphs',
                [

                    'monthlyTimelines'      => $monthlyTimelines,
                    'currencyNameAndSymbol' => $currencyNameAndSymbol,
                    'companyId'             => $companyId,
                    'projectsType'          => "clientProjects",

                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }
    public function generateReport(Request $request)
    {

        $monthlyTimelines = unserialize($request->monthlyTimelines);

        $projectsTimelines = $this->ReportService->getProjectsTimelinesFrom($monthlyTimelines);

        return $this->pdfview($request, $projectsTimelines,$monthlyTimelines);

    }

    public function export(Request $request)
    {
       

        $monthlyTimelines = unserialize($request->projectsTimelines);
        $projectsTimelines = $this->ReportService->getProjectsTimelinesFrom($monthlyTimelines);
        //to test excel view and graphs view
         // return view('reports/excelView',
         //    [
         //        'projectsTimelines' => $projectsTimelines,
         //        'monthlyTimelines'=>$monthlyTimelines,
         //    ]);
          // return view('reports/graphs',
          //   [
        
          //       'monthlyTimelines'=>$monthlyTimelines,

          //   ]);

        $excelSheet=\Excel::create('Report', function ($excel) use ($projectsTimelines,$monthlyTimelines) {
            $excel->sheet('ExportFile', function ($sheet) use ($projectsTimelines,$monthlyTimelines) {
                $sheet->loadView('reports/excelView',
                 [
                    'projectsTimelines' => $projectsTimelines,
                    'monthlyTimelines'=>$monthlyTimelines,
                ]);
            });
        });

        $excelSheet->export('xls');

    }

    public function pdfview($request, $projectsTimelines,$monthlyTimelines)
    {
        //to test pdf view and graphs view
        // return view('reports/pdfview',
        //     [
        //         'projectsTimelines' => $projectsTimelines,
        //     

        //     ]);
         // return view('reports/graphs',
        //     [
        
        //         'monthlyTimelines'=>$monthlyTimelines,

        //     ]);

        $pdfView     = \View::make('reports/pdfview', 
            [
                'projectsTimelines' => $projectsTimelines,
                'monthlyTimelines'=>$monthlyTimelines,
              
            ]);
        $pdfViewContents = (string) $pdfView;

        // or
        
        // $pdfViewContents = $view->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($pdfViewContents);

        return $pdf->stream();

    }

}
