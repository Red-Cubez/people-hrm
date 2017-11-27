<section class="showCompanyCurrentClientSection">
    @permission(StandardPermissions::showClients)
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Clients
        </h3>
    </div>
     <div class="panel-body">
              @if (count($companyProfileModel->companyClients) > 0)
                <div class="scroll-panel-table table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                    <th  >Client Name</th>
                    <th  >Contact Person</th>
                    <th  >Contact Number</th>
                    <th  >Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companyProfileModel->companyClients as $client)
                        <tr>
                            <td  >{{ $client->clientName }}</td>
                            <td>{{ $client->contactPerson}}</td>
                            <td >{{ $client->contactNumber}}</td>
                            <td >
                                <a href="/clients/{{$client->clientId}}">
                                    <button class="button20">
                                        <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                    </button></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
        @else
            No Record Found
        @endif
                @permission(StandardPermissions::createEditClient)
                    <div class="padTop20">
                     <a href="/clients/showclientform/{{$companyProfileModel->companyId}}" class="button button40 pull-right">
                        Add New Client  
                     </a>
                   </div>
                @endpermission  
</div>
</div>
@endpermission
</section>
