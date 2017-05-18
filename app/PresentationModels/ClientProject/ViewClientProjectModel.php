<?php

namespace People\PresentationModels\ClientProject;

use People\PresentationModels\ProjectModel;

class ViewClientProjectModel extends ProjectModel
{
    public function __set($name, $value){
        throw new \Exception("Dynamic properties shouldn't be set");
    }
}