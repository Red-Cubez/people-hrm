<section class="currentInternalProjectsView">

</section>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Internal Projects
        </h3>
    </div>

        @if (count($companyProfileModel->companyProjects) > 0)
        <table class="table table-fixed table-condensed">
            <thead>
            <tr>
                <th class="col-xs-2">Name</th>
                <th class="col-xs-1">Expected Start Date</th>
                <th class="col-xs-1">Expected End Date</th>
                <th class="col-xs-1">Actual Start Date</th>
                <th class="col-xs-1">Actual End Date</th>
                <th class="col-xs-1">Budget</th>
                <th class="col-xs-1">Cost</th>
                 @permission([StandardPermissions::deleteCompanyProject,StandardPermissions::viewCompanyProject])
                <th class="col-xs-4">Operations</th>
                @endpermission
            </tr>
            </thead>
            <tbody>
                @foreach ($companyProfileModel->companyProjects as $project)
                <tr>
                    <td class="col-xs-2 ">
                        <div class="padTop30">
                            {{ $project->projectName }}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->expectedStartDate }}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->expectedEndDate }}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->actualStartDate }}
                        </div>
                    </td>
                    <td class="col-xs-1">
                        <div class="padTop30">
                            {{ $project->actualEndDate }}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->budget}}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->cost }}
                        </div>
                    </td>
                    <td class="col-xs-4">
                        {{--<ul class="list-inline">--}}
                            {{--<li class="list-inline-item">--}}
                            @permission(StandardPermissions::viewCompanyProject)
                            <a href="/companyprojects/{{$project->projectId}}">
                                <button class="button20">
                                    <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                                </button></a>
                            @endpermission
                            {{--</li>--}}
                            {{--<li class="list-inline-item">--}}
                                @permission(StandardPermissions::deleteCompanyProject)
                                <form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    {{--<input name="_method" type="hidden" value="DELETE">--}}
                                    <button class="button20" data-toggle="confirmation" data-singleton="true" type="submit">
                                        <i class="fa fa-trash fa-2x"></i>
                                    </button>
                                </form>
                                @endpermission
                            {{--</li>--}}
                        {{--</ul>--}}
                    </td>
                </tr>
                @endforeach
                @else
                No Record Found
                @endif
            </tbody>
        </table>

    @permission(StandardPermissions::createEditCompanyProject)
        <div class="panel-body">
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