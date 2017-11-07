<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Projects
        </h3>
    </div>

        @if (count($companyProfileModel->clientProjects) > 0)
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
               @permission([ StandardPermissions::viewClientProject,StandardPermissions::deleteClientProject])
                <th class="col-xs-4">Operations</th>
                @endpermission
            <tr>
            </thead>
            <tbody>
                @foreach ($companyProfileModel->clientProjects as $project)
                <tr>
                    <td class="col-xs-2 ">
                        <div class="padTop30">
                            {{ $project->projectName }}
                        </div>
                    </td>
                    <td  class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->expectedStartDate }}
                        </div>
                    </td>
                    <td  class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->expectedEndDate }}
                        </div>
                    </td>
                    <td  class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->actualStartDate }}
                        </div>
                    </td>
                    <td  class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->actualEndDate }}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->budget}}
                        </div>
                    </td>
                    <td  class="col-xs-1 ">
                        <div class="padTop30">
                            {{ $project->cost }}
                        </div>
                    </td>
               
                    <td class="col-xs-4">
                @permission(StandardPermissions::deleteClientProject)
                        <form action="{{ url('clientprojects/'.$project->projectId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            <input name="_method" type="hidden" value="DELETE">
                                <button class="button20" data-toggle="confirmation" data-singleton="true"  type="submit">
                                    <i class="fa fa-trash fa-2x"></i>
                                </button>
                            </input>
                        </form>
                @endpermission
                @permission(StandardPermissions::viewClientProject)
                        <a href="{{route('clientprojects.show', $project->projectId)}}">
                            <button class="button20">
                                <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
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
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>