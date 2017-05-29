@if (count($companyProfileModel->companyEmployees) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Current Employees</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Hire Date</th>
                </thead>
                <!-- Table Body -->
                <tbody>

                @foreach ($companyProfileModel->companyEmployees as $employee)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>{{ $employee->firstName }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $employee->lastName}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $employee->hireDate}}</div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endif



