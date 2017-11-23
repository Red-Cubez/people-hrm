<?php

namespace People\Services;

use People\Services\Interfaces\IValidationService;
use Validator;

class ValidationService implements IValidationService
{
    public function validateCompanyForm($request)
    {
        $validate = Validator::make($request->all(), array(
            'name'               => 'required|max:255',
            'normalHoursPerWeek' => 'nullable|numeric',
            'applyOverTimeRule'  => 'boolean',
            'streetLine1'        => 'nullable|max:255',
            'streetLine2'        => 'nullable|max:255',
            'stateProvince'      => 'nullable|max:255',
            'country'            => 'nullable|max:255',
        ))->validate();

        return $validate;

    }
     public function validateClientForm($request)
     {
        $validate = Validator::make($request->all(), array(
            'name'          => 'required|max:255',
                'contactPerson' => 'nullable|max:25',
                'contactEmail'  => 'nullable|email',
                'streetLine1'   => 'nullable|max:255',
                'streetLine2'   => 'nullable|max:255',
                'stateProvince' => 'nullable|max:255',
                'country'       => 'nullable|max:255',
        ))->validate();

        return $validate;
     }

}
