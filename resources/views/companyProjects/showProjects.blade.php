<section class="currentInternalProjectsView">

</section>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Internal Projects
        </h3>
    </div>
    <div class="panel-body ">
        @if (count($companyProfileModel->companyProjects) > 0)
            <div class="scroll-panel-table table-responsive">
        <table class="table   table-border-grey">
            <thead>
            <tr>
                <th>Name</th>
                <th>Expected Start Date</th>
                <th>Expected End Date</th>
                <th>Actual Start Date</th>
                <th>Actual End Date</th>
                <th>Budget</th>
                <th>Cost</th>
                 @permission([StandardPermissions::deleteCompanyProject,StandardPermissions::viewCompanyProject])
                <th>Operations</th>
                @endpermission
            </tr>
            </thead>
            <tbody>
                @foreach ($companyProfileModel->companyProjects as $project)
                <tr>
                    <td>{{ $project->projectName }}</td>
                    <td >{{ $project->expectedStartDate }}</td>
                    <td>{{ $project->expectedEndDate }}</td>
                    <td>{{ $project->actualStartDate }}</td>
                    <td>{{ $project->actualEndDate }}</td>
                    <td >{{ $project->budget}}</td>
                    <td >{{ $project->cost }}</td>
                    <td>
                        <form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">
                        <div class="aParent">
                                <span>
                                    @permission(StandardPermissions::viewCompanyProject)
                            <a href="/companyprojects/{{$project->projectId}}">
                                 <button class="button20">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                 </button>
                            </a>
                                </span>
                            @endpermission
                            @permission(StandardPermissions::deleteCompanyProject)
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <span >
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="button20" data-toggle="confirmation" data-singleton="true" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                 </span>
                            @endpermission
                        </div>
                        </form>
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
        <button class="button button40 pull-right"> Add New Projects

        </button></a>
    @endpermission
        </div>
</div>
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
});
</script>