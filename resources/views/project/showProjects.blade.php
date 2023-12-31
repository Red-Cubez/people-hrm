@if (count($companyprojects) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Current Projects</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                <th>Name</th>
                <th>Expected Start Date</th>
                <th>Expected End Date</th>
                <th>Actual Start Date</th>
                <th>Actual End Date</th>
                <th>Budget</th>
                <th>Cost</th>
                <th>Operations</th>

                </thead>
                <tbody>
                @foreach ($companyprojects as $companyproject)
                    <tr>
                        <td class="table-text">
                            <div>{{ $companyproject->name }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $companyproject->expectedStartDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $companyproject->expectedEndDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $companyproject->actualStartDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $companyproject->actualEndDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $companyproject->budget }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $companyproject->cost }}</div>
                        </td>
                        <td>
                            <form action="{{ url('companyprojects/'.$companyproject->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                            <form action="{{ url('companyprojects/'.$companyproject->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"> Edit</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endif