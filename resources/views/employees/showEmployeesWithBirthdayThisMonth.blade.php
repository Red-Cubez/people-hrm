<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            BirthDays in {{date('M')}}
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->employeesBirthday) > 0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Employee First Name
                </th>
                <th>
                    Employee Last Name
                </th>
                <th>
                    Date of Birth
                </th>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($companyProfileModel->employeesBirthday as $employee)
                <tr>
                    <!--  Name -->
                    <td class="table-text">
                        <div>
                            {{ $employee->firstName }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $employee->lastName}}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ date("d-M",strtotime(($employee->birthDate))) }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>