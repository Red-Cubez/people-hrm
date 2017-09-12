@role(['client-manager','manager','admin'])
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Clients
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyClients) > 0)
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>
                    Client Name
                </th>
                <th>
                    Contact Person
                </th>
                <th>
                    Contact Number
                </th>
                <th>
                    Operation
                </th>
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach ($companyProfileModel->companyClients as $client)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>
                                {{ $client->clientName }}
                            </div>
                        </td>
                        <td class="table-text">
                            <div>
                                {{ $client->contactPerson}}
                            </div>
                        </td>
                        <td class="table-text">
                            <div>
                                {{ $client->contactNumber}}
                            </div>
                        </td>
                        <td>
                            <a href="/clients/{{$client->clientId}}">
                                <button class="btn btn-primary"> View

                                </button></a>
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif
    </div>
    @role(['client-manager','manager','admin'])
    <a href="/clients/showclientform/{{$companyProfileModel->companyId}}">
        <button class="btn btn-primary"> Add New Client

        </button></a>
     @endrole   
</div>
@endrole