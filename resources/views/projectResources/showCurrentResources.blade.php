<div class="panel-body">
    <!-- Display Validation Errors -->
@include('common.errors')
<!-- New clientProject Form -->
<!-- <form action="{{url('projectresources') }}" method="POST" class="form-horizontal">
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
                    <th>&nbsp;</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($projectResources as $projectResource)
                        <tr>
                            <!-- clientProject Name -->
                            <td class="table-text">
                                <div>
                                    {{ $projectResource->resourceName}}
                                </div>

                            </td>

                            <td>
                                <form action=" {{ url('projectresources/'.$projectResource->resourceId.'/updateResource') }}"
                                      method="POST">

                                    {{ csrf_field() }}
                                    {{ method_field('GET') }}

                                    <button type="submit" class="btn">

                                        <i class="fa fa-trash"> EDIT </i>
                                    </button>
                                </form>
                                <form action="{{ url('projectresources/'.$projectResource->resourceId) }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}


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