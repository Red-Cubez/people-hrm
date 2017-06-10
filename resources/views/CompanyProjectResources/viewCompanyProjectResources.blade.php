<div class="panel-body">
    <!-- Display Validation Errors -->
@include('common.errors')
<!-- New clientProject Form -->
<!--  <form action="{{url('projectresources') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }} -->
    <!-- Resource Name -->
    @if (count($projectResources)>0 )
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Resources
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                    <th>Project</th>
                    <th>Operations</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($projectResources as $projectResource)
                        <tr>
                            <!-- clientProject Name -->
                            <td class="table-text">
                                @if(isset($projectResource->employee))
                                    <div>
                                        {{ $projectResource->employee->firstName}} {{$projectResource->employee->lastName}}
                                    </div>
                                @elseif (isset($projectResource->title))
                                    <div>
                                        {{ $projectResource->title}}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <form action=" {{ url('companyprojectresources/'.$projectResource->id.'/edit') }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('GET') }}
                                    <button type="submit" class="btn">
                                        <i class="fa fa-trash"> EDIT </i>
                                    </button>
                                </form>
                                <form action="{{ url('companyprojectresources/'.$projectResource->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="companyProjectId" value="{{$projectResource->company_project_id}}">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"> Delete </i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>

@endif