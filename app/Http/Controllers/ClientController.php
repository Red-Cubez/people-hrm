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

		return redirect('/clients');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \People\Models\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function show(Client $client) {
		// dd('this is it');

		$clientProjects = $this->ClientService->getClientProjects($client);

		return view('clients/showClient',
			['client' => $client,
				'clientProjects' => $clientProjects,
			]);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \People\Models\Client  $client
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Client $client) {
		//
		return view('clients/clientEditForm', ['client' => $client]);
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

		return redirect('/clients/' . $client->id);
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
