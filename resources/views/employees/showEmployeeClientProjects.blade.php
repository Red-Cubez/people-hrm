 <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Client Projects</h3>
                </div>
                <div class="panel-body">
  @if (!is_null($employeeModel->clientProjects))

                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead>
                            <th>Project Name </th>
                            <th>Client Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Hours Per Week</th>

                    @permission(StandardPermissions::showClientProjects)
                              <th>Operations</th>
                    @endpermission

                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($employeeModel->clientProjects as $clientProject)

                                <tr>
         
                                    <td class="table-text">
                                        <div>{{ $clientProject->projectName }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $clientProject->clientName}}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $clientProject->projectStartDate }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $clientProject->projectEndDate }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $clientProject->hoursPerWeek }}</div>
                                    </td>

                    @permission(StandardPermissions::viewClientProject)
                                    <td>
         
                                         <a href="/clientprojects/{{$clientProject->projectId}}">
                                         <button class="btn btn-primary"> View

                                         </button></a>
                                    </td>

                   @endpermission
                                    
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
 @else
 No Record Found
@endif
                </div>
</div>



