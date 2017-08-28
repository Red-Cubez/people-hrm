<div class="panel panel-default" id="jobTitlePage">
    <div class="panel-heading">
        <h3>
            Company Job Titles
        </h3>
    </div>
    <div class="panel-body">
<a data-href="http://google.com" class="btn" data-toggle="confirmation">Confirmation</a>
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
                        <td>
                            <button
                                    class="btn btn-primary edit" 
                                    onclick="openJobTitleModal({{$companyJobTitle->jobTitleId}},null);"
                                    type="button">
                                Edit
                            </button>

                            <button class="btn btn-danger" onclick="deleteJobTitle({{$companyJobTitle->jobTitleId}});"
                                    type="submit">
                                DELETE
                            </button>
                        </td>
                    </tr>
                @endforeach

            @endif

            </tbody>
        </table>
    </div>
    <button id="test" class="btn btn-primary btn-lg" onclick="openJobTitleModal(null,null);" type="button">
        Add New Job Title
    </button>
</div>
@include('jobTitles/jobTitleModal')

@section('page-scripts')
    @parent


    <script type="text/javascript">
        function initializeJobTitleModal() {
            // $('#jobTitleName').val(null);
            // $('#toBeUpdatedJobTitle').val(null);
             $("#jobTitleNotEnteredDiv").remove();
             $('#jobTitleModalForm')[0].reset();
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
            if(form.valid())
            {
            // if(validateJobTitle())
            // {

            var jobTitleId = $('#toBeUpdatedJobTitle').val();

            if (jobTitleId == '' || jobTitleId === null) {
                addJobTitle();
            }
            else {
                updateJobTitle();
            }
        }
    }
        //}
        // if(validateJobTitle())
        // {
           
        //      $("#jobTitleNotEnteredDiv").remove();
               
        //         var html = '<div id="jobTitleNotEnteredDiv" class="alert alert-danger">Please Enter Job Title</div>';

        //         $("#jobTitleName").before(html);
            
        // }
        //}

        // function validateJobTitle()
        // {
        //     jobTitleName=$('#jobTitleName').val();

        //     if(jobTitleName!='' || jobTitleName!=' ' || jobTitleName != null)
        //     {

        //         return true;
        //     }
        //     else if(jobTitleName=='' || jobTitleName==' ' || jobTitleName == null)
        //     {
                
        //         return false;
        //     }

        // }
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

                        var html = '\
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
                        <button class="btn btn-danger" onclick="deleteJobTitle(\'' + data.jobTitleId + '\')" type="submit"> \
                            <i class="fa fa-trash">DELETE</i> \
                        </button> \
                    </td> \
                    </tr>';
                        $('#jobTitle_' + jobTitleId).html(html);
                    }
                },
            });
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

                        var jobTitle = data.jobTitle;
                        var editButton = $('<button>Edit</button>').click(function () {

                            openJobTitleModal(data.jobTitleId);
                        });
                        var deleteButton = $('<button>Delete</button>').click(function () {

                            deleteJobTitle(data.jobTitleId);
                        });

                        var html = '\
                 <tr id="jobTitle_' + data.jobTitleId + '">\
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
                        <button class="btn btn-danger" onclick="deleteJobTitle(\'' + data.jobTitleId + '\')" type="submit"> \
                            <i class="fa fa-trash">DELETE</i> \
                        </button> \
                    </td> \
                    </tr>';
                        $("#jobTitleTableBody").append(html);
                    }
                }
            });
        }
    </script>
@endsection
