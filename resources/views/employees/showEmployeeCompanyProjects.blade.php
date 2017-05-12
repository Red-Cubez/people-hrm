
 @if (count($employeeCompanyProjects) > 0)
              <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Company Projects</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead>
                            <th>Project Name </th>
                            <th>Company Name</th>
                            <th>Start Date</th>
                            <th>Hours Per Week</th>

                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($employeeModel->employeeCompanyProjects as $employeeClientProject )
                                <tr>
                                    <!-- Project Name -->
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->name }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ "company name" }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->actualStartDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $employeeClientProject[0]->hoursPerWeek }}</div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @endif

