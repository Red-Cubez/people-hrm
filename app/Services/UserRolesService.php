<?php

namespace People\Services;

use People\Models\User;
use People\Services\Interfaces\IUserRolesService;

class UserRolesService implements IUserRolesService
{

    public function getUsersWithRoles()
    {
        $usersWithRoles = User::orderBy('created_at','desc')->with('roles')->get();
        return $usersWithRoles;

    }
    public function getUserWithRoles($userId)
    {
    	$userRoles = User::with('roles')->find($userId);
        return $userRoles;
    }

    public function saveRolesInArray($user)
    {
        $rolesArray=array();

        foreach($user->roles as $role)
        {
            array_push($rolesArray,$role->id);
        }
        return $rolesArray;
    }

    public function getUser($userId)
    {
        return User::find($userId);
    }

}
