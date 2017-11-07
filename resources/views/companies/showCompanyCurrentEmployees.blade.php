<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Employees
        </h3>
    </div>
    @if (count($companyProfileModel->companyEmployees) > 0)
            <table class="table table-fixed table-condensed">
                <thead>
                <tr>
                <th class="col-xs-3">First Name</th>
                <th class="col-xs-3">Last Name</th>
                <th class="col-xs-2">Hire Date</th>
                @permission([
                    StandardPermissions::createEditEmployee,
                    StandardPermissions::viewOthersProfile
                    ])
                <th class="col-xs-4">Operation</th>
                @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach ($companyProfileModel->companyEmployees as $employee)
                    <tr>
                        <td class="col-xs-3 ">
                            <div>
                                {{ $employee->firstName }}
                            </div>
                        </td>
                        <td class="col-xs-3 ">
                            <div>
                                {{ $employee->lastName}}
                            </div>
                        </td>
                        <td class="col-xs-2 ">
                            <div>
                                {{ $employee->hireDate}}
                            </div>
                        </td>
                        <td class="col-xs-4 ">

                          @permission(StandardPermissions::viewOthersProfile)
                            <a href="/employees/{{$employee->employeeId}}">
                                <button  class="button20">
                                    <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
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

    @permission(StandardPermissions::createEditEmployee)
    <div class="panel-body">
    <a href="/employees/showemployeeform/{{$companyProfileModel->companyId}}">
        <button class="button button40 pull-right"> Add New Employee

        </button></a>
    </div>
  @endpermission
</div>
