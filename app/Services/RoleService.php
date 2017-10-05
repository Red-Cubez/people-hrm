<?php

namespace People\Services;

use People\Models\Role;
use People\Services\Interfaces\IRoleService;

class RoleService implements IRoleService
{
    public function getAllRoles()
    {
        return Role::where('name','!=','employee')->get();
    }
    public function saveRole($request)
    {
        $role = new Role();

        $role->name         = $request->name;
        $role->display_name = $request->displayName;
        $role->description  = $request->description;

        $role->save();

    }
       public function getDefaultRole()
        {
            $role=Role::where('name','employee')->first(); 
            if(isset($role))
            {
                return $role;

            } 
            else
            {
                return NULL;
            }
        }
    public function getRole($id)
    {
        return Role::find($id);
    }

    public function updateRole($request, $id)
    {
        $role = Role::find($id);

        $role->name         = $request->name;
        $role->display_name = $request->displayName;
        $role->description  = $request->description;

        $role->save();
    }

    public function deleteRole($id)
    {
        Role::whereId($id)->delete();
       
    }

}
