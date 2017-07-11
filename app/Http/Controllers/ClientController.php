<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Client;
use People\Services\Interfaces\IClientService;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ClientService;

    public function __construct(IClientService $clientService)
    {

        $this->ClientService = $clientService;
    }
    public function showClientForm($companyId)
    {


        $clients = $this->ClientService->getAllClients();

        return view('clients.index',
            [
                'clients' => $clients,
                'companyId' => $companyId,

            ]);
    }
    public function index(Request $request)
    {

        $clients = $this->ClientService->getAllClients();

        return view('clients.index',
            [
                'clients' => $clients,
                'companyId' => $request->companyId,

            ]);
    }

    /**s
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientId = $this->ClientService->createClient($request);

        return redirect('/clients/' . $clientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client, Request $request)
    {

        $clientProjects = $this->ClientService->getClientProjects($client);

        return view('clients/showClient',
            ['client' => $client,
                'clientProjects' => $clientProjects,
                'companyId' => $request->companyId,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, Request $request)
    {

        return view('clients/clientEditForm',
            [
                'client' => $client,
                'companyId' => $request->companyId,

            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->ClientService->updateClient($request, $client);

        return redirect('/clients/' . $client->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */

    public function destroy(Client $client)
    {
        $this->ClientService->deleteClient($client);

        return redirect('/companies/' . $client->company_id);

    }
}
