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
                            <div id="jobTitle_{{$companyJobTitle->jobTitleId}}">{{$companyJobTitle->jobTitle }}</div>
                        </td>
                        <td>

                            <button
                                    type="button"
                                    class="btn btn-primary btn-lg"
                                    data-toggle="modal"
                                    onclick="buttonEdit({{$companyJobTitle->jobTitleId}})"
                                    data-target="#editJobTitleModal">
                                Edit
                            </button>
                            {{--<form action="{{ url('jobtitle/'.$companyJobTitle->jobTitleId.'/edit') }}" method="POST">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('GET') }}--}}

                            {{--<button type="submit" class="btn btn-danger">--}}
                            {{--<i class="fa fa-trash">Edit</i>--}}
                            {{--</button>--}}
                            {{--</form>--}}
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

        <form action="{{ url('jobtitle/'.$companyProfileModel->companyId) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('GET') }}

            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash"> Add New Job Title</i>
            </button>

        </form>
    </div>

    <div class="modal fade" id="editJobTitleModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="editJobTitleModalLabel">Edit Job Title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">JobTitle:</label>
                        <input type="text" class="form-control" id="jobTitleName">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                    <span class="pull-right">
          <button type="button" class="btn btn-primary" onclick="buttonUpdate()">
            Update Job Title
          </button>
        </span>
                </div>
            </div>
        </div>
    </div>

@endif
@section('page-scripts')

    <script type="text/javascript">
        function buttonEdit(jobTitleId) {

            var jobTitleValue = $('#jobTitle_' + jobTitleId).html();
            window.globalVar = jobTitleId;
            $("#jobTitleName").val(jobTitleValue);

        }

        function buttonUpdate() {
            var newValue = $("#jobTitleName").val();
            jobTitleId = globalVar;


            $.ajax({
                type: 'post',
                url: '/updatejobtitle',
                data: {
                    // '_token': $('input[name=_token]').val(),
                    'name': $('newValue')
                },

//
//
//           // $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphiscon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
//
//        },
            });
        }

    </script>
@endsection






