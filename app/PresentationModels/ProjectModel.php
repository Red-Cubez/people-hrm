<?php

namespace People\PresentationModels;

abstract class ProjectModel
{
    public $projectId;
    public $name;
    public $actualStartDate;
    public $actualEndDate;
    public $expectedStartDate;
    public $expectedEndDate;
    public $budget;
    public $cost;
    public $isProjectOnTime;
    public $isProjectOnBudget;

}