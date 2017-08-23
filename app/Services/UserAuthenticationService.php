<?php
namespace People\Services;

use Illuminate\Support\Facades\Auth;
use People\Services\Interfaces\IUserAuthenticationService;
class UserAuthenticationService implements IUserAuthenticationService
{
    public function canEmployeeView($requestId)
    {
        $user = Auth::user();
        if ($user->employee->id == $requestId) {
             return true;
         }
        else{
                return false;
            }
              }

}
