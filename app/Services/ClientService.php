<?php

namespace People\Services;
use People\Models\Client;
use People\Models\ClientAddress;
use People\Models\ClientProject;
use People\Models\Company;
use People\Services\Interfaces\IClientService;

class ClientService implements IClientService {

	public function getAllClients() {
		$clients = Client::orderBy('created_at', 'asc')->get();
		return $clients;
	}

	public function deleteClient($client) {
		$clientProjects = ClientProject::where('client_id', $client->id)->orderBy('created_at', 'asc')->get();

		foreach ($clientProjects as $clientProject) {
			$clientProject->delete();
		}
		$client->delete();
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

	public function createClient($createRequest) {
		$client = new Client();
		$client->name = $createRequest->name;
		$client->contactNumber = $createRequest->contactNumber;
		$client->contactEmail = $createRequest->contactEmail;
		$client->contactPerson = $createRequest->contactPerson;

		$company = Company::find(1);
		$client->company_id = $company->id;
		$client->save();

		$this->createOrUpdateClientAddress($createRequest, null, $client->id);

	}

	public function updateClient($request, $client) {

		//
		//$clientAddress = ClientAddress::where('client_id', '=', $client->id)->get();
		//dd($clientAddress);
		$client->name = $request->name;
		$client->contactNumber = $request->contactNumber;
		$client->contactEmail = $request->contactEmail;
		$client->contactPerson = $request->contactPerson;
		$this->createOrUpdateClientAddress($request, $client->address, $client->id);

		$client->save();
		//	$client->save();

	}

}
