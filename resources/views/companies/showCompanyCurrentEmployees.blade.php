<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Employees
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyEmployees) > 0)
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>
                    First Name
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    Hire Date
                </th>
                @permission([
                    StandardPermissions::getPermissionName(StandardPermissions::createEditEmployee),
                    StandardPermissions::getPermissionName(StandardPermissions::viewOthersProfile)
                    ])
                <th>
                    Operation
                </th>
                @endpermission
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach ($companyProfileModel->companyEmployees as $employee)
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
                                {{ $employee->hireDate}}
                            </div>
                        </td>
                        <td>

                          @permission(StandardPermissions::getPermissionName(StandardPermissions::viewOthersProfile))
                            <a href="/employees/{{$employee->employeeId}}">
                                <button class="btn btn-primary"> View

                                </button></a>
                         @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            No Record Found
        @endif
    </div>
    @permission(StandardPermissions::getPermissionName(StandardPermissions::createEditEmployee))
    <a href="/employees/showemployeeform/{{$companyProfileModel->companyId}}">
        <button class="btn btn-primary"> Add New Employee

        </button></a>
  @endpermission
</div>
