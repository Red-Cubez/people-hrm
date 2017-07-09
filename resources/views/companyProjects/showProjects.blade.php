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
                <th>
                    Operations
                </th>
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
                        <form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
                                </button>
                            </input>
                        </form>
                        <form action="{{ url('companyprojects/'.$project->projectId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('GET') }}
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-trash">
                                    View
                                </i>
                            </button>
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

    <form action="{{ url('/companies/'.$companyProfileModel->companyId.'/companyprojects') }}" method="POST">
        {{ csrf_field() }}
            {{ method_field('GET') }}
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-trash">
                Add New Projects
            </i>
        </button>
    </form>
</div>
