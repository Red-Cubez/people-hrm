<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Current Projects
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->clientProjects) > 0)
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
               @permission(['view-clientProject','delete-clientProject'])
                <th>
                    Operations
                </th>
                @endpermission
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($companyProfileModel->clientProjects as $project)
                <tr>
            
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
               
                    <td>
                     @permission('delete-clientProject')
                        <form action="{{ url('clientprojects/'.$project->projectId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" data-toggle="confirmation" data-singleton="true"  type="submit">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
                                </button>
                            </input>
                        </form>
                    @endpermission
                     @permission('view-clientProject')
                        <a href="{{route('clientprojects.show', $project->projectId)}}"> <button class="btn btn-primary"> View </button></a>

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
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>