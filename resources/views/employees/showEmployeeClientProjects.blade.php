 <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Client Projects</h3>
                </div>
                <div class="panel-body">
  @if (!is_null($employeeModel->clientProjects))
                        <div class="scroll-panel-table table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Project</th>
                            <th>Client</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Hours/Week</th>
                            @permission(StandardPermissions::showClientProjects)
                            <th></th>
                           @endpermission
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeModel->clientProjects as $clientProject)
                                <tr>
                                    <td >{{ $clientProject->projectName }}</td>
                                     <td >{{ $clientProject->clientName}}</td>
                                     <td >{{ $clientProject->projectStartDate }}</td>
                                     <td >{{ $clientProject->projectEndDate }}</td>
                                    <td >{{ $clientProject->hoursPerWeek }}</td>

                    @permission(StandardPermissions::viewClientProject)
                                    <td>
                                        <a href="/clientprojects/{{$clientProject->projectId}}">
                                         <button class="button20">
                                           <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                         </button></a>
                                    </td>
                                    @endpermission
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
 @else
 No Record Found
@endif
                </div>
</div>



