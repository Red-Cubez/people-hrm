 <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Client Projects</h3>
                </div>
                <div class="panel-body">
  @if (!is_null($employeeModel->clientProjects))
                        <div class="scroll-panel-table table-responsive">
                    <table class="table table-border-grey">
                        <thead>
                        <tr>
                            <th>Project Name </th>
                            <th>Client Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Hours Per Week</th>
                            @permission(StandardPermissions::showClientProjects)
                            <th>Operations</th>
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
                                             <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
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



