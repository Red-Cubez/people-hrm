
 @if (count($employeeClientProjects) > 0)
              <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Company Projects</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead>
                            <th>Name </th>
                            <th>Expected Start Date</th>
                            <th>Expected End Date</th>
                            <th>Actual Start Date</th>
                            <th>Actual End Date</th>
                            <th>Budget</th>
                            <th>Cost</th>
                            <th>Operations</th>

                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($employeeClientProjects as $employeeClientProject)
                                <tr>
                                    <!-- clientProject Name -->
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->name }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->expectedStartDate }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->expectedEndDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->actualStartDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->actualEndDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->budget}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->cost }}</div>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @endif}
}
