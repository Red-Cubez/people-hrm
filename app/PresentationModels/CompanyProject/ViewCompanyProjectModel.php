<?php

namespace People\PresentationModels\CompanyProject;

use People\PresentationModels\ProjectModel;

class ViewCompanyProjectModel extends ProjectModel{
    public function __set($name, $value){
        throw new \Exception("Dynamic properties shouldn't be set");
    }
}