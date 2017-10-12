<?php

namespace People\Services\Interfaces;

interface IRoleService {

	public function getAllRoles();
	// public function saveRole($request);
	// public function getRole($id);
	// public function updateRole($request,$id);
	// public function deleteRole($id);
	public function getDefaultRole();

  public function getRoles();
  public function pluckRoles();
  public function createRole($request);
  public function updateRole($request , $role);
  public function deleteRole($role);


}
