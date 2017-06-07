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
                            <form action="{{ url('clients/'.$client->clientId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <input name="companyId" type="hidden" value="{{$companyProfileModel->companyId}}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-trash">
                                        View
                                    </i>
                                </button>
                                </input>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif
    </div>
    <form action="{{ url('clients/') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}
        <input name="companyId" type="hidden" value="{{$companyProfileModel->companyId}}">
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-trash">
                Add new Client
            </i>
        </button>
        </input>
    </form>
</div>
