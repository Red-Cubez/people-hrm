@if (count($companyProfileModel->jobTitles) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Company Job Titles</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- Table Headings -->
                <thead>
                <th>Job Title Name</th>
                </thead>
                <!-- Table Body -->
                <tbody>

                @foreach ($companyProfileModel->jobTitles as $companyJobTitle)
                    <tr>
                        <!--  Name -->
                        <td class="table-text">
                            <div>{{$companyJobTitle->jobTitle }}</div>
                        </td>
                        <td>

                            <form action="{{ url('jobtitle/'.$companyJobTitle->jobTitleId.'/edit') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash">Edit</i>
                                </button>
                            </form>
                            <form action="{{ url('jobtitle/'.$companyJobTitle->jobTitleId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash">DELETE</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
@section('page-scripts')
            <script type="text/javascript">
//                $(document).ready(function () {
                        alert('test 1');
//                    }
//                )
            </script>
@endsection






