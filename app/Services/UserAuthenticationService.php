<?php
namespace People\Services;

use Illuminate\Support\Facades\Auth;
use People\Services\Interfaces\IUserAuthenticationService;
class UserAuthenticationService implements IUserAuthenticationService
{
    public function isAllowToShow($requestId)
    {
        \Log::info('here0');
        $user = Auth::user();
         \Log::info('here');
        if ($user->employee->id == $requestId) {
\Log::info('here1');
             return true;
         }
        else{
            \Log::info('here2');
                return false;
            }
            \Log::info('here3');
    }

}
