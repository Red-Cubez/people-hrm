<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Company Projects</h3>
    </div>
    <div class="panel-body">
        @if (!is_null($employeeModel->companyProjects))
            <div class="scroll-panel-table table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Company</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Hours/Week</th>
                         @permission(StandardPermissions::showCompanyProjects)
                        <th></th>
                         @endpermission
                    </tr>
                </thead>
                <tbody>
                @foreach ($employeeModel->companyProjects as $companyProject )
                        <tr>
                            <td >{{ $companyProject->projectName }}</td>
                            <td >{{ $companyProject->companyName}}</td>
                            <td >{{ $companyProject->projectStartDate }}</td>
                            <td >{{ $companyProject->projectEndDate }}</td>
                            <td >{{ $companyProject->hoursPerWeek }}</td>
                            @permission(StandardPermissions::viewCompanyProject)
                            <td>
                                <a href="/companyprojects/{{$companyProject->projectId}}">
                                 <button class="button20">
                                   <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
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
</div>