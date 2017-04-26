<?php

namespace People\Http\Controllers;
use Illuminate\Http\Request;
use People\Models\Client;
use People\Services\ClientService;
use People\Services\Interfaces\IClientService;

class ClientController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public $ClientService;

	public function __construct(IClientService $clientService) {

		$this->ClientService = $clientService;
	}

	public function index() {
		$clients = $this->ClientService->getAllClients();
		// dd($clients[0]->address);
		//$clientAddresses = ClientAddress::orderBy('created_at', 'asc')->get();
		// $clientAddresses = ClientAddress::where('client_id', '=', '$clients->id')->orderBy('created_at', 'asc')->get();
		// echo $clientAddresses;
		return view('clients.index', ['clients' => $clients]);
	}

	/**s
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
	*/
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->ClientService->createClient($request);
		// 	$client = new Client();
		// $clientAddress = new ClientAddress();
		// $client->name = $request->name;
		// $client->contactNumber = $request->contactNumber;
		// $client->contactEmail = $request->contactEmail;
		// $client->contactPerson = $request->contactPerson;
		// $clientAddress->streetLine1 = $request->streetLine1;
		// $clientAddress->streetLine2 = $request->streetLine2;
		// $clientAddress->country = $request->country;
		// $clientAddress->stateProvince = $request->stateProvince;
		// $clientAddress->city = $request->city;
		// //TODO These properties need to be set from fields
		// $company = Company::find(1);
		// //dd($company);
		// $client->company_id = $company->id;
		// $client->save();
		// $clientAddress->client_id = $client->id;
		// //$clientid = Client::where('id', '=', 1)->get();
		// //$clientAddress->client_id = $clientid->id;DD\

		// $clientAddress->save();
		// return redirect('/clients');
		//TODO These properties need to be set from fields

		return redirect('/clients');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function show(Client $client) {
		return view('clients/clientEditForm', ['client' => $client]);

	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Client $client) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \People\Models\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Client $client) {
		//
		//$clientAddress = ClientAddress::where('client_id', '=', $client->id)->get();
		//dd($clientAddress);
		$this->ClientService->updateClient($request, $client);

		return redirect('/clients');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \People\Models\Client  $client
	 * @return \Illuminate\Http\Response
	 */

	public function destroy(Client $client) {
		$this->ClientService->deleteClient($client);

		return redirect('/clients');

	}
}
