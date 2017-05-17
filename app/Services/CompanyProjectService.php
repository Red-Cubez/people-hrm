<?php

namespace People\Services;
use People\Models\CompanyProject;
use People\Services\Interfaces\ICompanyProjectService;
use People\PresentationModels\CompanyProject\ViewCompanyProjectModel;

class CompanyProjectService implements ICompanyProjectService {

	public function getAllCompanyProjects() {

		$companyprojects = CompanyProject::orderBy('created_at', 'asc')->get();
		return $companyprojects;
	}

    private function isProjectOnTime($companyProject) {
        $currentDate = date("Y-m-d");
        $isOnTime="Not On";
        if (($companyProject->actualEndDate) != NULL ) {
            if ((($companyProject->actualEndDate) >= $currentDate)) {

                $isOnTime = "On";
            }
        }
        elseif ($companyProject->expectedEndDate != NULL &&($companyProject->actualEndDate == NULL)) {

            if (($companyProject->expectedEndDate) >= $currentDate) {
                $isOnTime = "On";
            }
        }
        else {
            $isOnTime="Not On";
        }
        return $isOnTime;
    }
    private function isProjectOnBudget($companyProject)
    {
        $cost=$companyProject->cost;
        $budget=$companyProject->budget;

        if($cost<$budget)
        {
            $isOnBudget="On";
        }
        else{
            $isOnBudget="Not On";
        }
        return $isOnBudget;
    }

    public function viewCompanyProject($companyProjectId) {

        $companyProject=CompanyProject::find($companyProjectId);

        $isOnTime=$this->isProjectOnTime($companyProject);
        $isOnBudget=$this->isProjectOnBudget($companyProject);

        $companyProjectModel =new ViewCompanyProjectModel();

        $companyProjectModel->id=$companyProject->id;
        $companyProjectModel->name=$companyProject->name;
        $companyProjectModel->actualStartDate=$companyProject->actualStartDate;
        $companyProjectModel->actualEndDate=$companyProject->actualEndDate;
        $companyProjectModel->expectedStartDate=$companyProject->expectedStartDate;
        $companyProjectModel->expectedEndDate=$companyProject->expectedEndDate;
        $companyProjectModel->budget=$companyProject->budget;
        $companyProjectModel->cost=$companyProject->cost;
        $companyProjectModel->isProjectOnTime=$isOnTime;
        $companyProjectModel->isProjectOnBudget=$isOnBudget;

        return $companyProjectModel;

	}

	public function saveCompanyProject($request) {

		$companyProject = new CompanyProject();

		$companyProject->name = $request->name;
		$companyProject->expectedStartDate = $request->expectedStartDate;
		$companyProject->expectedEndDate = $request->expectedEndDate;
		$companyProject->actualStartDate = $request->actualStartDate;
		$companyProject->actualEndDate = $request->actualEndDate;
		$companyProject->budget = $request->budget;
		$companyProject->cost = $request->cost;
		$companyProject->company_id = $request->companyid;
		//TODO These properties need to be set from fields
		//TODO this value needs to come from the correct client Project

		$companyProject->save();

	}

	public function updateCompanyProject($request, $companyproject) {

		$companyproject->name = $request->name;
		$companyproject->expectedStartDate = $request->expectedStartDate;
		$companyproject->expectedEndDate = $request->expectedEndDate;
		$companyproject->actualStartDate = $request->actualStartDate;
		$companyproject->actualEndDate = $request->actualEndDate;
		$companyproject->budget = $request->budget;
		$companyproject->cost = $request->cost;

		$companyproject->save();

	}

	public function deleteCompanyProject($companyproject) {

		$companyproject->delete();
	}

	public function manageProject($companyid) {

		$companyProjects = CompanyProject::where('company_id', $companyid)->orderBy('created_at', 'asc')->get();

		return $companyProjects;
	}

}
