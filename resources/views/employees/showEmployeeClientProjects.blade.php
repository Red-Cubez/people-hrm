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
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($employeeModel->clientProjects as $clientProject)
                              @if($clientProject->isActive)
                                <tr>
                                    <!-- clientProject Name -->
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


                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
 @else
 No Record Found
@endif
                </div>
</div>



