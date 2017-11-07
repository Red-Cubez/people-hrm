@permission(StandardPermissions::showClients)
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Clients
        </h3>
    </div>

        @if (count($companyProfileModel->companyClients) > 0)
            <table class="table table-fixed table-condensed">
                <thead>
                <tr>
                <th class="col-xs-3">Client Name</th>
                <th class="col-xs-3">Contact Person</th>
                <th class="col-xs-3">Contact Number</th>
                <th class="col-xs-3">Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companyProfileModel->companyClients as $client)
                    <tr>

                        <td class="col-xs-3">
                            <div>
                                {{ $client->clientName }}
                            </div>
                        </td>
                        <td class="col-xs-3">
                            <div>
                                {{ $client->contactPerson}}
                            </div>
                        </td>
                        <td class="col-xs-3">
                            <div>
                                {{ $client->contactNumber}}
                            </div>
                        </td>
                        <td class="col-xs-3">
                            <a href="/clients/{{$client->clientId}}">
                                <button class="button20">
                                    <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                                </button></a>
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif

    @permission(StandardPermissions::createEditClient)
    <div class="panel-body">
    <a href="/clients/showclientform/{{$companyProfileModel->companyId}}">
        <button class="button button40 pull-right">
            Add New Client
        </button></a>
    </div>
     @endpermission  
</div>
@endpermission