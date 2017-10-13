<?php

namespace People\Services\Interfaces;

interface IReportService
{

    public function getInternalProjectsTimelines($companyId, $startDate, $endDate);

    public function getClientProjectsTimelines($companyId, $startDate, $endDate);
    public function getStartAndEndDateTimelines($startDate, $endDate);

    public function mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines);
    public function getMonthlyProfit($startAndEndDateTimelines, $projectsTimelines);
    public function getTotalRevenue($startAndEndDateTimelines, $projectsTimelines);
    public function startAndEndDateTimelinesWithCostProfitAndNetTotal($startDate, $endDate, $companyId);

    public function setUpMontlhyTimelines($monthlyTimelines);

    public function generateAllProjectsReport($monthlyTimelines);
    public function generateInternalProjectsReport($monthlyTimelines);
    public function generateClientProjectsReport($monthlyTimelines);

}
