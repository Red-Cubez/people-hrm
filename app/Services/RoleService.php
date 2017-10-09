<?php

namespace People\Services;

use People\Models\Role;
use People\Services\Interfaces\IRoleService;

class RoleService implements IRoleService
{

    public function getRoles()
    {
        $roles = Role::orderBy('name', 'asc')->with('perms')->get();
        return $roles;
    }

    public function pluckRoles()
    {
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
        return $roles;
    }

    public function createRole($request)
    {
        $role = new Role;
        $this->setupRole($request, $role);
    }

    public function updateRole($request, $role)
    {
        $this->setupRole($request, $role);
    }

    public function deleteRole($role)
    {
        Role::whereId($role)->delete();
    }

    private function setupRole($request, $role)
    {
        $role->name         = $request->name;
        $role->display_name = $request->display_name;
        $role->description  = $request->description;
        $role->save();
        if (isset($request->permissions)) {
            $role->attachPermissions($request->permissions);
        }
    }

    public function getAllRoles()
    {
        return Role::where('name','!=','employee')->get();
    }
    // public function saveRole($request)
    // {
    //     $role = new Role();

    //     $role->name         = $request->name;
    //     $role->display_name = $request->displayName;
    //     $role->description  = $request->description;

    //     $role->save();

    // }
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
    // public function getRole($id)
    // {
    //     return Role::find($id);
    // }

    // public function updateRole($request, $id)
    // {
    //     $role = Role::find($id);

    //     $role->name         = $request->name;
    //     $role->display_name = $request->displayName;
    //     $role->description  = $request->description;

    //     $role->save();
    // }

    // public function deleteRole($id)
    // {
    //     Role::whereId($id)->delete();

    // }

}
