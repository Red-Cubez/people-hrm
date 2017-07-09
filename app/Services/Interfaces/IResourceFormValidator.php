<?php

namespace People\Services\Interfaces;

interface IResourceFormValidator
{
    public function validateForm($request);

    public function validateProjectForm($request);

}
