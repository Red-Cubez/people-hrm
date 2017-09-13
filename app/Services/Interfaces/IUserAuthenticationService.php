<?php

namespace People\Services\Interfaces;

interface IUserAuthenticationService
{

    //public function canEmployeeView($requestId);
    public function getCurrrentLogedInUserDetails();
   // public function getRolesOfUser($id);
    public function isAdmin();
    public function isManager();
    public function isEmployee();
    public function isHrManager();
    public function isClientManager();
    public function canEmployeeView($requestId);
    public function isRequestedEmployeeBelongsToSameCompany($requestId);
    public function isRequestedCompanyBelongsToEmployee($requestedCompanyId);
    public function isRequestedClientBelongsToSameCompany($requestedClientId);
    public function redirectToErrorMessageView($message);

}
