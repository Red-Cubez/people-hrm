<div class="panel panel-default" id="jobTitlePage">
    <div class="panel-heading">
        <h3>
            Company Job Titles
        </h3>
    </div>
    <div class="panel-body">

        <table id="jobTitleTable" class="table table-striped task-table">


            <!-- Table Headings -->
            @if (count($companyProfileModel->jobTitles) > 0)
            <thead>
                <th>
                    Job Title Name
                </th>
            </thead>
            @endif

            <!-- Table Body -->
            <tbody id="jobTitleTableBody">
             @if (count($companyProfileModel->jobTitles) > 0)
                @foreach ($companyProfileModel->jobTitles as $companyJobTitle)
                <tr id="jobTitle_{{$companyJobTitle->jobTitleId}}">

                    <!--  Name -->
                    <td class="table-text">
                        <div id="jobTitle_{{$companyJobTitle->jobTitleId}}">
                            {{$companyJobTitle->jobTitle }}
                        </div>
                    </td>
                    <td >
                        <button
                        class="btn btn-primary btn-lg"
                        onclick="openJobTitleModal({{$companyJobTitle->jobTitleId}},null);"
                        type="button">
                        Edit
                        </button>

                        <button class="btn btn-danger" onclick="deleteJobTitle({{$companyJobTitle->jobTitleId}})" type="submit">
                            <i class="fa fa-trash">DELETE</i>
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
            No Record Found
            @endif

            </tbody>
        </table>
    </div>
    <button class="btn btn-primary btn-lg" onclick="openJobTitleModal(null,null);" type="button">
        Add New Job Title
    </button>
</div>
@include('jobTitles/jobTitleModal')

@section('page-scripts')
<script type="text/javascript">
    function initializeJobTitleModal()
    {
        $('#jobTitleName').val(null);
        //$('#jobTitleId').val(null);
        $('#toBeUpdatedJobTitle').val(null);
    }
    function setupJobTitleEditValues(jobTitleId,jobTitle) {

        if(jobTitle==null)
        {
        var jobTitleValue = $('#jobTitle_' + jobTitleId).text().trim();

    }
    else
    {
         var jobTitleValue=jobTitle;

    }
     $("#jobTitleName").val(jobTitleValue);



}
    function openJobTitleModal(jobTitleId,jobTitle) {

        initializeJobTitleModal();
        ///alert(jobTitleId);
        if (jobTitleId !== null) {
            $('#toBeUpdatedJobTitle').val(jobTitleId);
            setupJobTitleEditValues(jobTitleId,jobTitle);
            $('#addUpdateJobTitleButton').html('Update Job Title');
        }
        else{
            $('#addUpdateJobTitleButton').html('Add Job Title');
        }
        $('#jobTitleModal').modal('show');
    }

    function addUpdateJobTitle()
    {
        var jobTitleId = $('#toBeUpdatedJobTitle').val();

        if (jobTitleId == '' || jobTitleId === null) {
            addJobTitle();
                  }
        else
        {
            updateJobTitle();

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

                    ///$("#jobTitlePage").load("http://people.app/companies/3 #jobTitlePage");
                }
            },
        });
    }
    function updateJobTitle() {
        var newValue = $("#jobTitleName").val();
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
                } else {
//------------------------------------here------------------------------------------
                    $('#jobTitleModal').modal('toggle');
                    $('#jobTitleName').val(null);
                    $('#jobTitleId').val(null);
                    $('#jobTitle_' + jobTitleId).text(data.jobTitle);
                    $('.error').remove();
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
                } else {

                    $('#jobTitleModal').modal('toggle');
                    $('#jobTitleName').val(null);

                  var jobTitle = data.jobTitle;
                  var editButton = $('<button>Edit</button>').click(function () {

                     openJobTitleModal(data.jobTitleId);
                     });
                  var deleteButton = $('<button>Delete</button>').click(function () {

                     deleteJobTitle(data.jobTitleId);
                     });

                  var html =  '\
                 <tr id="jobTitle_' + data.jobTitleId + ' ">\
                    <td class="table-text">\
                        <div id="jobTitle_' + data.jobTitleId + ' ">\
                            ' + data.jobTitle + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary btn-lg" \
                        onclick="openJobTitleModal(\'' + data.jobTitleId +'\',\''+ data.jobTitle +'\');" \
                        type="button"> \
                        Edit \
                        </button> \
                        <button class="btn btn-danger" onclick="deleteJobTitle(' + data.jobTitleId + ')" type="submit"> \
                            <i class="fa fa-trash">DELETE</i> \
                        </button> \
                    </td> \
                    </tr>"\
                    ';
                      //var  jobTitleId="jobTitle_"+data.jobTitleId;
                     $("#jobTitleTableBody").append(html);
                    //$(jobTitleId).text(data.jobTitle);
                   }
                 }
            });
        }
</script>
@endsection
