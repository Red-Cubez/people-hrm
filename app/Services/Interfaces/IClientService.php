<?php

namespace People\Services\Interfaces;

interface IClientService {

	public function createClient($createRequest);
	public function deleteClient($client);
	public function updateClient($request, $client);
	public function getAllClients();
	public function getClientProjects($client);

}
