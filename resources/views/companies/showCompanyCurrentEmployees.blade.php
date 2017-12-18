<section class="showCompanyCurrentEmployeesSection">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Employees  
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyEmployees) > 0)
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
                <th ></th>
                @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach ($companyProfileModel->companyEmployees as $employee)
                    <tr>
                        <td  >{{ $employee->firstName }}</td>
                        <td >{{ $employee->lastName}}</td>
                        <td >{{ $employee->hireDate}}</td>
                         @permission(StandardPermissions::viewOthersProfile)
                        <td>
                         <a href="/employees/{{$employee->employeeId}}">
                         <button  class="button20">
                                   <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                         </button>
                         </a>
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
            @permission(StandardPermissions::createEditEmployee)
                <div class="padTop20">
                    <a href="/employees/showemployeeform/{{$companyProfileModel->companyId}}" class="button button40 pull-right">
                    Add New Employee
                    </a>
                </div>
            @endpermission
    </div>
</div>

</section>
