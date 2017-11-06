<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Internal Projects
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyProjects) > 0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Name
                </th>
                <th>
                    Expected Start Date
                </th>
                <th>
                    Expected End Date
                </th>
                <th>
                    Actual Start Date
                </th>
                <th>
                    Actual End Date
                </th>
                <th>
                    Budget
                </th>
                <th>
                    Cost
                </th>
                 @permission([StandardPermissions::deleteCompanyProject,StandardPermissions::viewCompanyProject])
                <th>
                    Operations
                </th>
                @endpermission
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($companyProfileModel->companyProjects as $project)
                <tr>
                    <!-- company->project Name -->
                    <td class="table-text">
                        <div>
                            {{ $project->projectName }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $project->expectedStartDate }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $project->expectedEndDate }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $project->actualStartDate }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $project->actualEndDate }}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $project->budget}}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{ $project->cost }}
                        </div>
                    </td>
                    <!-- Delete Button -->
                    <td>
                @permission(StandardPermissions::deleteCompanyProject)
                        <form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" data-toggle="confirmation" data-singleton="true" type="submit">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
                                </button>
                                
                            </input>
                        </form>
                @endpermission
                @permission(StandardPermissions::viewCompanyProject)
                        <a href="/companyprojects/{{$project->projectId}}">
                            <button class="btn btn-primary"> View

                            </button></a>
                @endpermission
                                         </td>
                </tr>
                @endforeach
                @else
                No Record Found
                @endif
            </tbody>
        </table>
    </div>
    @permission(StandardPermissions::createEditCompanyProject)
    <a href="/companies/{{$companyProfileModel->companyId}}/companyprojects">
        <button class="button button10"> Add New Projects

        </button></a>
    @endpermission
</div>
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
});
</script>