@permission(StandardPermissions::showClients)
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Clients
        </h3>
    </div>
    @if (count($companyProfileModel->companyClients) > 0)
        <div class="panel-body">
            <table class="table table-fixed table-condensed table-border-grey">
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
                                    <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
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
            <a href="/clients/showclientform/{{$companyProfileModel->companyId}}" class="button button40 pull-right">
                Add New Client
            </a>
    </div>
     @endpermission  
</div>
@endpermission