<?php
namespace People\Services;

use Illuminate\Support\Facades\Auth;
use People\Services\Interfaces\IUserAuthenticationService;

//use Zizaco\Entrust\Entrust;
class UserAuthenticationService implements IUserAuthenticationService
{
    public function canEmployeeView($requestId)
    {

        $isAdmin = \Entrust::hasRole('admin');

        $user = Auth::user();
        //$role = Role::findOrFail($user->id);

        if ($user->employee->id == $requestId) {

            return true;
        }

        if ($isAdmin) {
            return true;
        } else {
            return false;
        }
    }

}
