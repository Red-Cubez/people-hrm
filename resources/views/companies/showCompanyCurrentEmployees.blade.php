<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Employees
        </h3>
    </div>
    @if (count($companyProfileModel->companyEmployees) > 0)
        <div class="panel-body">
            <div class="scroll-panel-table table-responsive">
            <table class="table table-bordered table-hover table-striped ">
                <thead>
                <tr>
                <th  >First Name</th>
                <th  >Last Name</th>
                <th  >Hire Date</th>
                @permission([
                    StandardPermissions::createEditEmployee,
                    StandardPermissions::viewOthersProfile
                    ])
                <th >Operation</th>
                @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach ($companyProfileModel->companyEmployees as $employee)
                    <tr>
                        <td  >{{ $employee->firstName }}</td>
                        <td >{{ $employee->lastName}}</td>
                        <td >{{ $employee->hireDate}}</td>
                        <td >
                            @permission(StandardPermissions::viewOthersProfile)
                            <a href="/employees/{{$employee->employeeId}}">
                                <button  class="button20">
                                   <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                </button></a>
                         @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        @else
            No Record Found
        @endif
            @permission(StandardPermissions::createEditEmployee)
            <a href="/employees/showemployeeform/{{$companyProfileModel->companyId}}">
        <button class="button button40 pull-right"> Add New Employee
        </button></a>
    </div>
  @endpermission
</div>
