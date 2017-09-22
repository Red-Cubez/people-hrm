<?php

namespace People\Services\Interfaces;

interface IReportService
{

    public function getInternalProjectsTimelines($companyId, $startDate, $endDate);

    public function getClientProjectsTimelines($companyId, $startDate, $endDate);
    public function getStartAndEndDateTimelines($startDate, $endDate);
    public function calculateMonthlyCost($projectsTimelines, $months);
    public function mapMonthlyCostToStartAndEndDateTimelines($startAndEndDateTimelines, $projectsTimelines);
    public function getMonthlyProfit($startAndEndDateTimelines,$projectsTimelines);
    public function getNetTotal($startAndEndDateTimelines,$projectsTimelines);

}
