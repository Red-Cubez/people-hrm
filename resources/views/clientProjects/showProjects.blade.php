@if (count($clientProjects) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Current Projects</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
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
                <!-- Table Body -->
                <tbody>
                @foreach ($clientProjects as $clientProject)
                    <tr>
                        <!-- clientProject Name -->
                        <td class="table-text">
                            <div>{{ $clientProject->name }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $clientProject->expectedStartDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $clientProject->expectedEndDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $clientProject->actualStartDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $clientProject->actualEndDate }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $clientProject->budget}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $clientProject->cost }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <a href="/clientprojects/{{$clientProject->id}}">
                                <button class="btn btn-primary"> View

                                </button></a>
                           

                            <form action="{{ url('clientprojects/'.$clientProject->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" data-toggle="confirmation" data-singleton="true">
                                    <i class="fa fa-trash"> Delete </i>
                                </button>
                            </form>
                            <a href="/clientprojects/{{$clientProject->id}}/projectresources">
                                <button class="btn btn-primary"> Manage Resource

                                </button></a>
                           
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endif
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>