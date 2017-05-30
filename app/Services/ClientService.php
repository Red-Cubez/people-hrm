<?php

namespace People\Services;

use People\Models\Client;
use People\Models\ClientAddress;
use People\Models\ClientProject;
use People\Services\Interfaces\IClientService;

class ClientService implements IClientService {

	public function getAllClients() {
		$clients = Client::orderBy('created_at', 'asc')->get();
		return $clients;
	}

	public function getClientProjects($client) {
		$clientProjects = ClientProject::where('client_id', $client->id)
			->orderBy('created_at', 'asc')
			->get();

		return $clientProjects;
	}

	public function deleteClient($client) {
		$clientProjects = ClientProject::where('client_id', $client->id)->orderBy('created_at', 'asc')->get();

		foreach ($clientProjects as $clientProject) {
			$clientProject->delete();
		}
		$client->delete();
	}

	public function createClient($createRequest) {
		$client = new Client();
		$client->name = $createRequest->name;
		$client->contactNumber = $createRequest->contactNumber;
		$client->contactEmail = $createRequest->contactEmail;
		$client->contactPerson = $createRequest->contactPerson;

		$client->company_id = $createRequest->companyId;
		$client->save();

		$this->createOrUpdateClientAddress($createRequest, null, $client->id);
		return $client->id;
	}

	public function createOrUpdateClientAddress($userRequest, $clientAddress, $clientId) {
		if (!isset($clientAddress)) {
			$clientAddress = new ClientAddress();
		}
		$clientAddress->streetLine1 = $userRequest->streetLine1;
		$clientAddress->streetLine2 = $userRequest->streetLine2;
		$clientAddress->country = $userRequest->country;
		$clientAddress->stateProvince = $userRequest->stateProvince;
		$clientAddress->city = $userRequest->city;
		$clientAddress->client_id = $clientId;
		$clientAddress->save();
	}

	public function updateClient($request, $client) {

		$client->name = $request->name;
		$client->contactNumber = $request->contactNumber;
		$client->contactEmail = $request->contactEmail;
		$client->contactPerson = $request->contactPerson;
		$this->createOrUpdateClientAddress($request, $client->address, $client->id);

		$client->save();
	}

}
