<?php
namespace People\Services;

use People\Services\Interfaces\IPermissionService;
use People\Models\Permission;

class PermissionService implements IPermissionService
{
  public function getPermissions()
  {
    $permissions = Permission::orderBy('name','asc')->get();
    return $permissions;
  }

  public function pluckPermissions()
  {
    $permissions = Permission::orderBy('id','asc')->pluck('name','id');
    return $permissions;
  }

  public function createPermission($request)
  {
    $permission = new Permission;
    $this->setupPermission($request,$permission);
  }

  public function updatePermission($request,$permission)
  {
    return $this->setupPermission($request,$permission);
  }

  public function deletePermission($permission)
  {
    $permission->delete();
  }

  private function setupPermission($request,$permission)
  {
    $permission->name         = $request->name;
    $permission->display_name = $request->display_name;
    $permission->description  = $request->description;
    $permission->save();
    return $permission->id;
  }
}
 ?>
