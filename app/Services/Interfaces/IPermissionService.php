<?php
namespace People\Services\Interfaces;

interface IPermissionService
{
  public function getPermissions();
  public function pluckPermissions();
  public function createPermission($request);
  public function updatePermission($request,$permission);
  public function deletePermission($permission);
}
 ?>
