<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Projects
        </h3>
    </div>

        @if (count($companyProfileModel->clientProjects) > 0)
        <div class="panel-body">
            <div class="scroll-panel-table table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th >Name</th>
                <th >Expected Start Date</th>
                <th  >Expected End Date</th>
                <th >Actual Start Date</th>
                <th  >Actual End Date</th>
                <th  >Budget</th>
                <th  >Cost</th>
               @permission([ StandardPermissions::viewClientProject,StandardPermissions::deleteClientProject])
                <th >Operations</th>
                @endpermission
            <tr>
            </thead>
            <tbody>
                @foreach ($companyProfileModel->clientProjects as $project)
                <tr>
                    <td>{{ $project->projectName }}</td>
                    <td>{{ $project->expectedStartDate }}</td>
                    <td>{{ $project->expectedEndDate }}</td>
                    <td >{{ $project->actualStartDate }}</td>
                    <td>{{ $project->actualEndDate }}</td>
                    <td >{{ $project->budget}}</td>
                    <td>{{ $project->cost }}</td>
                    <td>
                        <div class="aParent">
                            @permission(StandardPermissions::viewClientProject)
                                <a href="{{route('clientprojects.show', $project->projectId)}}" class="button20">
                                    <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                </a>
                            @endpermission
                            @permission(StandardPermissions::deleteClientProject)
                                <form action="{{ url('clientprojects/'.$project->projectId) }}" method="POST">
                                     {{ csrf_field() }}
                                     {{ method_field('DELETE') }}
                            {{--<input name="_method" type="hidden" value="DELETE">--}}
                                         <button class="button20" data-toggle="confirmation" data-singleton="true"  type="submit">
                                           <i class="fa fa-trash fa-2x"></i>
                                         </button>
                            {{--</input>--}}
                                </form>
                            @endpermission
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            </div>
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