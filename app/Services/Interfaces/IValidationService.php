<?php

namespace People\Services\Interfaces;

interface IValidationService
{

    public function validateCompanyForm($request);

    public function validateClientForm($request);

}
