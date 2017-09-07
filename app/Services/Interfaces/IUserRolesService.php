<?php

namespace People\Services\Interfaces;

interface IUserRolesService {

	public function getUsersWithRoles();

	public function getUserWithRoles($userId);

	public function saveRolesInArray($user);

	public function getUser($userId);
	
	
}
