<div class="panel panel-default" id="jobTitlePage">
    <div class="panel-heading">
        <h3>
            Company Job Titles
        </h3>
    </div>
    <div class="panel-body" >
        @if (count($companyProfileModel->jobTitles) > 0)
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
                        <button class="btn btn-primary btn-lg" data-target="#jobTitleModal" data-toggle="modal" onclick="buttonEdit({{$companyJobTitle->jobTitleId}})" type="button">
                            Edit
                        </button>

                            <button class="btn btn-danger" type="submit" onclick="deleteJobTitle({{$companyJobTitle->jobTitleId}})">
                                <i class="fa fa-trash">
                                    DELETE
                                </i>
                            </button>

                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

        <button class="btn btn-primary btn-lg" data-target="#jobTitleModal" data-toggle="modal" type="button">
            Add New Job Title
        </button>

</div>
@include('jobTitles/jobTitleModal')

@section('page-scripts')
<script type="text/javascript">
   function deleteJobTitle(jobTitleId) {
           var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

   $.ajax({
        type: 'DELETE',
        url: '/jobtitle/'+jobTitleId,
        data: {
            '_token': CSRF_TOKEN,

        },
        success: function(data) {
            if ((data.errors)) {
                alert('errors');
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
            } else {

                  $( "#jobTitlePage" ).load( "http://people.app/companies/3 #jobTitlePage" );
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
        success: function(data) {
            if ((data.errors)) {
                alert('errors');
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);

            } else {

                $('#jobTitleModal').modal('toggle');

                $('#jobTitleName').val('');
                 $( "#jobTitlePage" ).load( "http://people.app/companies/3 #jobTitlePage" );

            }

        },
    });

    }

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

                $('#jobTitleModal').modal('toggle');

                $('#jobTitleName').val('');

                $('#jobTitle_' + jobTitleId).text(data);
                $('.error').remove();
            }

        },
    });

}
</script>
@endsection
