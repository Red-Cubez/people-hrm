<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Projects
        </h3>
    </div>

        @if (count($companyProfileModel->clientProjects) > 0)
        <div class="panel-body">
        <table class="table table-fixed table-condensed table-border-grey">
            <thead>
            <tr>
                <th class="col-xs-1">Name</th>
                <th class="col-xs-2">Expected Start Date</th>
                <th class="col-xs-2">Expected End Date</th>
                <th class="col-xs-2">Actual Start Date</th>
                <th class="col-xs-2">Actual End Date</th>
                <th class="col-xs-1">Budget</th>
                <th class="col-xs-1">Cost</th>
               @permission([ StandardPermissions::viewClientProject,StandardPermissions::deleteClientProject])
                <th class="col-xs-1">Operations</th>
                @endpermission
            <tr>
            </thead>
            <tbody>
                @foreach ($companyProfileModel->clientProjects as $project)
                <tr>
                    <td class="col-xs-1 ">
                        <div >
                            {{ $project->projectName }}
                        </div>
                    </td>
                    <td  class="col-xs-2 ">
                        <div >
                            {{ $project->expectedStartDate }}
                        </div>
                    </td>
                    <td  class="col-xs-2 ">
                        <div >
                            {{ $project->expectedEndDate }}
                        </div>
                    </td>
                    <td  class="col-xs-2 ">
                        <div >
                            {{ $project->actualStartDate }}
                        </div>
                    </td>
                    <td  class="col-xs-2 ">
                        <div >
                            {{ $project->actualEndDate }}
                        </div>
                    </td>
                    <td class="col-xs-1 ">
                        <div >
                            {{ $project->budget}}
                        </div>
                    </td>
                    <td  class="col-xs-1 ">
                        <div >
                            {{ $project->cost }}
                        </div>
                    </td>
               
                    <td class="col-xs-1">

                        <div class="aParent">
                             <span>
                                 @permission(StandardPermissions::viewClientProject)
                                 <a href="{{route('clientprojects.show', $project->projectId)}}" class="button20">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                        </a>
                                 @endpermission
                            </span>
                                <div>
                                    @permission(StandardPermissions::deleteClientProject)
                        <form action="{{ url('clientprojects/'.$project->projectId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            {{--<input name="_method" type="hidden" value="DELETE">--}}
                                <button class="button20" data-toggle="confirmation" data-singleton="true"  type="submit">
                                    <i class="fa fa-trash "></i>
                                </button>
                            {{--</input>--}}
                        </form>
                                    @endpermission
                                </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
                No Record Found
        @endif

   
</div>
</div>
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>