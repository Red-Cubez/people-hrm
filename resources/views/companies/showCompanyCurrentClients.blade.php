@if (count($companyProfileModel->companyClients) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Current Clients</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>Client Name</th>
                <th>Contact Person</th>
                <th>Contact Number</th>
                </thead>
                <!-- Table Body -->
                <tbody>

                @foreach ($companyProfileModel->companyClients as $client)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>{{ $client->clientName }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->contactPerson}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->contactNumber}}</div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endif



