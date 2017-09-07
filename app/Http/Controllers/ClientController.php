<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Models\Client;
use People\Services\Interfaces\IClientService;
use People\Services\Interfaces\IUserAuthenticationService;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ClientService;

    public function __construct(IClientService $clientService, IUserAuthenticationService $userAuthenticationService)
    {
        $this->middleware('auth');
        $this->ClientService             = $clientService;
        $this->UserAuthenticationService = $userAuthenticationService;
    }
    public function showClientForm($companyId)
    {
        $isAdmin = $this->UserAuthenticationService->isAdmin();
        if ($isAdmin) {
            $clients = $this->ClientService->getAllClients();

            return view('clients.index',
                [
                    'clients'   => $clients,
                    'companyId' => $companyId,

                ]);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]
            );
        }
    }
    public function index(Request $request)
    {

        $clients = $this->ClientService->getAllClients();

        return view('clients.index',
            [
                'clients'   => $clients,
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
        $isAdmin = $this->UserAuthenticationService->isAdmin();
        if ($isAdmin) {
            $this->validate($request, array(
                'name' => 'required|max:255',
            ));
            $clientId = $this->ClientService->createClient($request);

            return redirect('/clients/' . $clientId);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]
            );
        }
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
            ['client'        => $client,
                'clientProjects' => $clientProjects,
                'companyId'      => $request->companyId,
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
        $isAdmin = $this->UserAuthenticationService->isAdmin();
        if ($isAdmin) {

            return view('clients/clientEditForm',
                [
                    'client'    => $client,
                    'companyId' => $request->companyId,

                ]);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]
            );
        }
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
        $isAdmin = $this->UserAuthenticationService->isAdmin();
        if ($isAdmin) {

            $this->validate($request, array(
                'name' => 'required|max:255',
            ));
            $this->ClientService->updateClient($request, $client);

            return redirect('/clients/' . $client->id);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]
            );
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */

    public function destroy(Client $client)
    {
        $isAdmin = $this->UserAuthenticationService->isAdmin();
        if ($isAdmin) {

            $this->ClientService->deleteClient($client);

            return redirect('/companies/' . $client->company_id);
        } else {
            return view('notAuthorize',
                [
                    'message' => 'You are Not Authorize to view this Page !!',
                ]
            );
        }
    }
}
