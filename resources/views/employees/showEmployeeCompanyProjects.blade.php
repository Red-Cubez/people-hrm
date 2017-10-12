<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Company Projects</h3>
    </div>
    <div class="panel-body">
        @if (!is_null($employeeModel->companyProjects))

            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>Project Name</th>
                <th>Company Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Hours Per Week</th>

                 @permission(StandardPermissions::showCompanyProjects)
                              <th>Operations</th>
                 @endpermission
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach ($employeeModel->companyProjects as $companyProject )

                        <tr>
                            <!-- Project Name -->
                            <td class="table-text">
                                <div>{{ $companyProject->projectName }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $companyProject->companyName}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $companyProject->projectStartDate }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $companyProject->projectEndDate }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $companyProject->hoursPerWeek }}</div>
                            </td>
                    @permission(StandardPermissions::viewCompanyProject)
                                    <td>
         
                                         <a href="/companyprojects/{{$companyProject->projectId}}">
                                         <button class="btn btn-primary"> View

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