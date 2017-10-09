<div class="panel panel-default" id="jobTitlePage">
    <div class="panel-heading">
        <h3>
            Company Job Titles
        </h3>
    </div>
    <div class="panel-body">

        <table id="jobTitleTable" class="table table-striped task-table">


            <!-- Table Headings -->

            <thead>
            <th>
                Job Title Name
            </th>
            </thead>

            <!-- Table Body -->
            <tbody id="jobTitleTableBody">
            @if (count($companyProfileModel->jobTitles) > 0)
                @foreach ($companyProfileModel->jobTitles as $companyJobTitle)
                    <tr id="jobTitle_{{$companyJobTitle->jobTitleId}}">

                        <!--  Name -->
                        <td class="table-text">
                            <div id="jobTitleName_{{$companyJobTitle->jobTitleId}}">
                                {{$companyJobTitle->jobTitle }}
                            </div>
                        </td>
                            @permission(['create/edit/delete-jobTitle'])
                        <td>
                            <button
                                    class="btn btn-primary"
                                    onclick="openJobTitleModal({{$companyJobTitle->jobTitleId}},null);"
                                    type="button">
                                Edit
                            </button>
                             <form action="{{url('jobtitle/'.$companyJobTitle->jobTitleId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" data-toggle="confirmation" data-singleton="true">
                                        Delete
                                    </button>
                            </form>
                           
                        </td>
                         @endpermission
                    </tr>
                @endforeach

            @endif

            </tbody>
        </table>
    </div>
    @permission(['create/edit/delete-jobTitle'])
    <div>
    <button class="btn btn-primary btn-lg" onclick="openJobTitleModal(null,null);" type="button">
        Add New Job Title
    </button>
    </div>
    @endpermission
</div>
@permission(['create/edit/delete-jobTitle'])
@include('jobTitles/jobTitleModal')
@endpermission
@section('page-scripts')
    @parent
    <script type="text/javascript">
        function initializeJobTitleModal() {
            $("#jobTitleNotEnteredDiv").remove();
            $('#jobTitleName').val(null);
            $('#toBeUpdatedJobTitle').val(null);
        }
        function setupJobTitleEditValues(jobTitleId, jobTitle) {

            if (jobTitle == null) {
                var jobTitleValue = $('#jobTitleName_' + jobTitleId).text().trim();
            }
            else {
                var jobTitleValue = jobTitle;
            }
            $("#jobTitleName").val(jobTitleValue);
        }
        function openJobTitleModal(jobTitleId, jobTitle) {

            initializeJobTitleModal();
            if (jobTitleId !== null) {
                $('#toBeUpdatedJobTitle').val(jobTitleId);
                setupJobTitleEditValues(jobTitleId, jobTitle);
                $('#addUpdateJobTitleButton').html('Update Job Title');
            }
            else {
                $('#addUpdateJobTitleButton').html('Add Job Title');
            }
            $('#jobTitleModal').modal('show');
        }

        function addUpdateJobTitle() {

            var form = $("#jobTitleModalForm");
            
            if(form.valid()){
            var jobTitleId = $('#toBeUpdatedJobTitle').val();

            if (jobTitleId == '' || jobTitleId === null) {
                addJobTitle();
            }
            else {
                updateJobTitle();
            }
        }
        }

        function deleteJobTitle(jobTitleId) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'DELETE',
                url: '/jobtitle/' + jobTitleId,
                data: {
                    '_token': CSRF_TOKEN,
                },
                success: function (data) {
                    if ((data.errors)) {
                        alert('errors');
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } else {

                        $('#jobTitle_' + jobTitleId).remove();
                    }
                },
            });
        }
        function updateJobTitle() {
            var newValue = $("#jobTitleName").val().trim();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            jobTitleId = $('#toBeUpdatedJobTitle').val();
            $.ajax({
                type: 'put',
                url: '/jobtitle/' + jobTitleId,
                data: {
                    '_token': CSRF_TOKEN,
                    'name': newValue
                },
                success: function (data) {
                    if ((data.errors)) {
                        alert('errors');
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } 
                    if(!data.isFormValid)
                    {
                         
                         $("#jobTitleNotEnteredDiv").remove();
               
                          var html = '<div id="jobTitleNotEnteredDiv" class="alert alert-danger">Please Enter Job Title</div>';

                          $("#jobTitleName").before(html);
                    }
                     else {
                        $('#jobTitleModal').modal('toggle');
                        $('#jobTitleName').val(null);
                        $('#jobTitleId').val(null);
                        var html=null;
                        html = createJobTitleHtmlRow(data);
                        
                        $('#jobTitle_' + jobTitleId).html(html);
                        initializeConfirmationBox();
                    }
                },
            });
        }
        function createJobTitleHtmlRow(data)
        {
                 var htmlRow=null;
                 htmlRow= '\
                    <td class="table-text">\
                        <div id="jobTitleName_' + data.jobTitleId + ' ">\
                            ' + data.jobTitle + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary" \
                        onclick="openJobTitleModal(\'' + data.jobTitleId + '\',\'' + data.jobTitle + '\');" \
                        type="button"> \
                        Edit \
                        </button> \
                        <form action="{{url('jobtitle')}}/' + data.jobTitleId + ' " method="POST">\
                                    {{ csrf_field() }}\
                                    {{ method_field('DELETE') }}\
                                    <button type="submit" class="btn btn-danger" data-toggle="confirmation"\ data-singleton="true">\
                                        Delete\
                                    </button>\
                            </form>\
                    </td> \
                    </tr>';
                    return htmlRow;
        }

        function addJobTitle() {
            var newValue = $("#jobTitleName").val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: '/jobtitle/',
                data: {
                    '_token': CSRF_TOKEN,
                    'name': newValue,
                    'companyId':<?php echo $companyProfileModel->companyId; ?>
                },
                success: function (data) {
                    if ((data.errors)) {
                        alert('errors');
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } 
                    if(!data.isFormValid)
                    {

                         $("#jobTitleNotEnteredDiv").remove();
               
                          var html = '<div id="jobTitleNotEnteredDiv" class="alert alert-danger">Please Enter Job Title</div>';

                          $("#jobTitleName").before(html);
                    }
                     else {

                        $('#jobTitleModal').modal('toggle');
                        $('#jobTitleName').val(null);

                        var html=null;
                        html = '\
                                   <tr id="jobTitle_' + data.jobTitleId + '">\
                                    '+ createJobTitleHtmlRow(data);'\
                                   </tr>';
                        $("#jobTitleTableBody").append(html);
                        initializeConfirmationBox();
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
function initializeConfirmationBox()
{
    $('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
    });
}
</script>
@endsection
