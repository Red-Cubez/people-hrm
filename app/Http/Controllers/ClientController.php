<?php

namespace People\Http\Controllers;

use Illuminate\Http\Request;
use People\Enums\StandardPermissions;
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
        $this->middleware('permission:' . StandardPermissions::getPermissionName(StandardPermissions::createEditClient),
            ['only' => ['showClientForm', 'store', 'edit', 'update']]);

        $this->middleware('permission:' . StandardPermissions::getPermissionName(StandardPermissions::viewClient),
            ['only' => ['show']]);

        $this->middleware('permission:' . StandardPermissions::getPermissionName(StandardPermissions::deleteClient), ['only' => ['destroy']]);

        $this->ClientService             = $clientService;
        $this->UserAuthenticationService = $userAuthenticationService;
    }
    public function showClientForm($companyId)
    {

        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($companyId);
        // $isManager                           = $this->UserAuthenticationService->isManager();
        // $isClientManager                     = $this->UserAuthenticationService->isClientManager();
        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();

        if ($isRequestedCompanyBelongsToEmployee) {

            $clients = $this->ClientService->getAllClients();

            return view('clients.index',
                [
                    'clients'   => $clients,
                    'companyId' => $companyId,

                ]);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
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
        // $isManager                           = $this->UserAuthenticationService->isManager();
        // $isClientManager                     = $this->UserAuthenticationService->isClientManager();
        // $isAdmin                             = $this->UserAuthenticationService->isAdmin();
        $isRequestedCompanyBelongsToEmployee = $this->UserAuthenticationService->isRequestedCompanyBelongsToEmployee($request->companyId);

        if ($isRequestedCompanyBelongsToEmployee) {
            $this->validate($request, array(
                'name' => 'required|max:255',
            ));
            $clientId = $this->ClientService->createClient($request);

            return redirect('/clients/' . $clientId);
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show($clientId)
    {

        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();
        $client = $this->ClientService->getClientDetails($clientId);

        if (isset($client)) {
            $isRequestedClientBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($clientId);
            if ($isRequestedClientBelongsToSameCompany) {
                $clientProjects = $this->ClientService->getClientProjects($client);

                return view('clients/showClient',
                    ['client'        => $client,
                        'clientProjects' => $clientProjects,
                        'companyId'      => $client->company_id,
                    ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit($clientId, Request $request)
    {

        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();
        $client = $this->ClientService->getClientDetails($clientId);

        if (isset($client)) {
            $isRequestedClientBelongsToSameCompany = $this->UserAuthenticationService->isRequestedClientBelongsToSameCompany($clientId);
            if ($isRequestedClientBelongsToSameCompany) {

                return view('clients/clientEditForm',
                    [
                        'client'    => $client,
                        'companyId' => $request->companyId,

                    ]);
            } else {
                return $this->UserAuthenticationService->redirectToErrorMessageView(null);
            }
        } else {
            return $this->UserAuthenticationService->redirectToErrorMessageView(null);

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
        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();

        //if ($isAdmin || $isManager || $isClientManager) {
        $this->validate($request, array(
            'name' => 'required|max:255',
        ));
        $this->ClientService->updateClient($request, $client);

        return redirect('/clients/' . $client->id);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \People\Models\Client $client
     * @return \Illuminate\Http\Response
     */

    public function destroy(Client $client)
    {
        // $isManager       = $this->UserAuthenticationService->isManager();
        // $isClientManager = $this->UserAuthenticationService->isClientManager();
        // $isAdmin         = $this->UserAuthenticationService->isAdmin();

        // if ($isAdmin || $isManager || $isClientManager) {

        $this->ClientService->deleteClient($client);

        return redirect('/companies/' . $client->company_id);
        // } else {
        //     return $this->UserAuthenticationService->redirectToErrorMessageView(null);
        // }
    }
}
