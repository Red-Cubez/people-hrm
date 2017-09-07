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
    public function canEmployeeView($requestId);

}
