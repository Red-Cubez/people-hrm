@if (count($companyProfileModel->jobTitles) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Job Titles
        </h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Job Title Name
                </th>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($companyProfileModel->jobTitles as $companyJobTitle)
                <tr>
                    <!--  Name -->
                    <td class="table-text">
                        <div id="jobTitle_{{$companyJobTitle->jobTitleId}}">
                            {{$companyJobTitle->jobTitle }}
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-lg" data-target="#editJobTitleModal" data-toggle="modal" onclick="buttonEdit({{$companyJobTitle->jobTitleId}})" type="button">
                            Edit
                        </button>
                        {{--
                        <form action="{{ url('jobtitle/'.$companyJobTitle->jobTitleId.'/edit') }}" method="POST">
                            --}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('GET') }}--}}

                            {{--
                            <button class="btn btn-danger" type="submit">
                                --}}
                            {{--
                                <i class="fa fa-trash">
                                    Edit
                                </i>
                                --}}
                            {{--
                            </button>
                            --}}
                            {{--
                        </form>
                        --}}
                        <form action="{{ url('jobtitle/'.$companyJobTitle->jobTitleId) }}" method="POST">
                            {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit">
                                <i class="fa fa-trash">
                                    DELETE
                                </i>
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
        <button class="btn btn-danger" type="submit">
            <i class="fa fa-trash">
                Add New Job Title
            </i>
        </button>
    </form>
</div>

    @include('jobTitles/updateJobTitleModal')

@endif
@section('page-scripts')
<script type="text/javascript">
    function buttonEdit(jobTitleId) {
            var jobTitleValue = $('#jobTitle_' + jobTitleId).text().trim();
            window.globalVar = jobTitleId;
            $("#jobTitleName").val(jobTitleValue);

        }

        function updateJobTitle() {
            var newValue = $("#jobTitleName").val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            jobTitleId = globalVar;

   $.ajax({
        type: 'put',
        url: '/jobtitle/'+jobTitleId,
        data: {
            '_token': CSRF_TOKEN,
            'name': newValue
        },
        success: function(data) {
            if ((data.errors)) {
                alert('errors');
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
            } else {

                $('#editJobTitleModal').modal('toggle');
                $('#jobTitle_' + jobTitleId).text(data);
                $('.error').remove();
            }
        },
    });
    }
</script>
@endsection
