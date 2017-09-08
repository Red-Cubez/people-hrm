<?php
namespace People\Services;

use People\Models\Employee;
use Illuminate\Support\Facades\Auth;
use People\Services\Interfaces\IUserAuthenticationService;

//use Zizaco\Entrust\Entrust;
class UserAuthenticationService implements IUserAuthenticationService
{
    // public function canEmployeeView($requestId)
    // {

    //     $isAdmin = \Entrust::hasRole('admin');

    //     $user = Auth::user();
    //     //$role = Role::findOrFail($user->id);

    //     if ($user->employee->id == $requestId) {

    //         return true;
    //     }

    //     if ($isAdmin) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function belongsToSameCompany($requestId)
    {
        $employee             = Employee::find($requestId);
        $logedInUser          = $this->getCurrrentLogedInUserDetails();
        $belongsToSameCompany = false;
    
        if ($logedInUser->employee->company_id == $employee->company_id) {
            $belongsToSameCompany = true;
        }
        return $belongsToSameCompany;

    }
    public function canEmployeeView($requestId)
    {
        $canEmployeeView = false;
        $logedInUser     = $this->getCurrrentLogedInUserDetails();

        if ($logedInUser->employee->id == $requestId) {
            $canEmployeeView = true;
        }
        return $canEmployeeView;

    }

    public function getCurrrentLogedInUserDetails()
    {
        $user = Auth::user();
        return $user;
    }

    public function isAdmin()
    {
        $isAdmin = \Entrust::hasRole('admin');
        return $isAdmin;

    }

    public function isManager()
    {

        $isManager = \Entrust::hasRole('manager');
        return $isManager;

    }
    public function isEmployee()
    {
        $isEmployee = \Entrust::hasRole('employee');
        return $isEmployee;

    }

}
