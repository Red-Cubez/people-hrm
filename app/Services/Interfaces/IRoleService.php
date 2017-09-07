<?php

namespace People\Services\Interfaces;

interface IRoleService {

	public function getAllRoles();
	public function saveRole($request);
	public function getRole($id);
	public function updateRole($request,$id);
	public function deleteRole($id);


}
