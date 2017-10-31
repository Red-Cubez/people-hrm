<?php
namespace People\Services;

use Illuminate\Support\Facades\Auth;
use People\Models\Client;
use People\Models\Employee;
use People\Services\Interfaces\IUserAuthenticationService;
use People\Services\StandardPermissions;

//use Zizaco\Entrust\Entrust;
class UserAuthenticationService implements IUserAuthenticationService
{

    public function isRequestedEmployeeBelongsToSameCompany($requestId)
    {
        $employee             = Employee::find($requestId);
        $logedInUser          = $this->getCurrrentLogedInUserDetails();
        $belongsToSameCompany = false;
        if (isset($employee)) {
            if ($logedInUser->employee->company_id == $employee->company_id) {
                $belongsToSameCompany = true;
            }
        }
        return $belongsToSameCompany;

    }
    public function isRequestedClientBelongsToSameCompany($requestedClientId)
    {
        $client               = Client::find($requestedClientId);
        $logedInUser          = $this->getCurrrentLogedInUserDetails();
        $belongsToSameCompany = false;

        if (isset($client)) {
            if ($logedInUser->employee->company_id == $client->company_id) {
                $belongsToSameCompany = true;
            }
        }
        return $belongsToSameCompany;
    }
    public function isRequestedCompanyBelongsToEmployee($requestedCompanyId)
    {
        $logedInUser = $this->getCurrrentLogedInUserDetails();

        if ($logedInUser->employee->company_id == $requestedCompanyId) {
            return true;
        } else {
            return false;
        }

    }
    public function canEmployeeView($requestId)
    {

        $canViewProfile       = false;
        $canViewOwnProfile    = false;
        $canViewOthersProfile = false;
        $logedInUser          = $this->getCurrrentLogedInUserDetails();

        if ($logedInUser->can(StandardPermissions::viewOwnProfile)) {
            if ($logedInUser->employee->id == $requestId) {
                $canViewOwnProfile = true;
            }

        }
        if ($logedInUser->can(StandardPermissions::viewOthersProfile)) {
            $canViewOthersProfile = true;

        }

        if ($canViewOwnProfile && $canViewOthersProfile) {
            $canViewProfile = true;

        } elseif ($canViewOwnProfile && !$canViewOthersProfile) {
            if ($logedInUser->employee->id == $requestId) {
                $canViewProfile = true;
            }

        } elseif (!$canViewOwnProfile && $canViewOthersProfile) {
            if ($logedInUser->employee->id != $requestId) {
                $canViewProfile = true;
            }

        } else {

            $canViewProfile = false;
        }

        return $canViewProfile;

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

    public function isClientManager()
    {
        $isClientManager = \Entrust::hasRole('client-manager');
        return $isClientManager;

    }

    public function isHrManager()
    {
        $isHrManager = \Entrust::hasRole('hr-manager');
        return $isHrManager;

    }
    public function redirectToErrorMessageView($message)
    {

        if (!isset($message)) {
            $message = "You are not Authorized to view this page !!";
        }
        return view('notAuthorized',
            [
                'message' => $message,
            ]);
    }

}
