
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">
        @if (count($companyProfileModel->companyHolidays) > 0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Holiday Name
                </th>
                <th>
                    Start Date
                </th>
                <th>
                    End Date
                </th>
                <th>
                    Total Holidays
                </th>
                <th>
                    Operations
                </th>
                <th>
                </th>
            </thead>
            <!-- Table Body -->
            <tbody id="holidayTableBody">
                @foreach ($companyProfileModel->companyHolidays as $companyHoliday)
                <tr id="holiday_{{$companyHoliday->holidayId}}">
                    <!--  Name -->
                    <td id="holidayName_{{$companyHoliday->holidayId}}" class="table-text">
                        <div>
                            {{ $companyHoliday->holidayName }}
                        </div>
                    </td>
                    <td id="startDate_{{$companyHoliday->holidayId}}" class="table-text">
                        <div>
                            {{ $companyHoliday->startDate }}
                        </div>
                    </td>
                    <td id="endDate{{$companyHoliday->holidayId}}" class="table-text">
                        <div>
                            {{ $companyHoliday->endDate }}
                        </div>
                    </td>
                    <td id="countHolidays_{{$companyHoliday->holidayId}}" class="table-text">
                        <div>
                            {{ $companyHoliday->countHolidays }}
                        </div>
                    </td>
                    <td>
                            <button class="btn btn-danger"  onclick="openHolidayModal({{$companyHoliday->holidayId,$companyHoliday->holidayName,$companyHoliday->startDate,$companyHoliday->endDate}});" type="button">
                                <i class="fa fa-trash">
                                    Edit
                                </i>
                            </button>

                    </td>
                    <!-- Delete Button -->
                    <td>
                                <button class="btn btn-danger" onclick="deleteHoliday({{$companyHoliday->holidayId}})" type="button">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
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

            <button class="btn btn-primary btn-lg" onclick="openHolidayModal(null,null,null,null);" type="button">
                Add Holiday
            </button>

</div>
@include('companyHolidays/companyHolidayModal')
@section('page-scripts')
<script type="text/javascript">

  function initializeHolidayModal()
    {
        $('#holidayName').val(null);
        //$('#jobTitleId').val(null);
        $('#toBeUpdatedHoliday').val(null);
    }
    function setupHolidayEditValues(holidayId,holidayName,startDate,endDate) {

        if(holidayName==null)
       {
         var holidayNameValue = $('#holidayName_' + holidayId).text().trim();
         var startDate = $('#startDate_' + holidayId).val();
         var endDate = $('#endDate_' + holidayId).val();


      }
    else
    {
        var holidayNameValue=holidayName;
        var startDate = startDate;
        var endDate = endDate;

    }
     $("#holidayName").val(holidayNameValue);
      $("#startDate").val(startDate);
       $("#endDate").val(endDate);



}
 function openHolidayModal(holidayId,holidayName,startDate,endDate) {

         initializeHolidayModal();

        if (holidayId !== null) {
             $('#toBeUpdatedHoliday').val(holidayId);
            setupHolidayEditValues(holidayId,holidayName,startDate,endDate);
            $('#addUpdateHolidayButton').html('Update Holiday');
        }
        else{
           $('#addUpdateHolidayButton').html('Add Holiday');
        }
        $('#holidayModal').modal('show');
    }

     function addUpdateHoliday()
     {
        var holidayId = $('#toBeUpdatedHoliday').val();

        if (holidayId == '' || holidayId === null) {
            addHoliday();
                  }
        else
        {
            updateHoliday();

        }
     }

     function updateHoliday() {
        var holidayName = $("#holidayName").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        holidayId = $('#toBeUpdatedHoliday').val();

        $.ajax({
            type: 'put',
            url: '/companyholidays/' + holidayId,
            data: {
                '_token': CSRF_TOKEN,
                'name': holidayName,
                'startDate':startDate,
                'endDate':endDate,
            },
            success: function (data) {
                if ((data.errors)) {
                    alert('errors');
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                } else {

                    $('#holiday_' + data.holidayId).remove();
                    $('#holidayModal').modal('toggle');

                    $('#holidayName').val(null);
                    $('#holidayId').val(null);
                    $('#holidayName_' + holidayId).text(data.jobTitle);
                    $('.error').remove();

                // var html=createHtmlRow();    TOOO DOOOOOOOOOOO
                 var html =  '\
                 <tr id="holiday_' + data.holidayId + ' ">\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.holidayName + '\
                        </div>\
                    </td>\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.startDate + '\
                        </div>\
                    </td>\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.endDate + '\
                        </div>\
                    </td>\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.holidays + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary btn-lg" \
                        onclick="openHolidayModal(\'' + data.holidayId +'\',\''+ data.holidayName +'\',\''+ data.startDate +'\',\''+ data.endDate +'\');" \
                        type="button"> \
                        Edit \
                        </button> \
                    </td> \
                    <td >\
                        <button class="btn btn-danger" onclick="deleteHoliday(' + data.holidayId + ')" type="submit"> \
                            <i class="fa fa-trash">DELETE</i> \
                        </button> \
                    </td> \
                    </tr>"\
                    ';

                     $("#holidayTableBody").append(html);




                }

            },
        });
        }

     function addHoliday()
      {

        var holidayName = $("#holidayName").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/companyholidays/',
            data: {
                '_token': CSRF_TOKEN,
                'name': holidayName,
                'startDate':startDate,
                'endDate':endDate,

                'companyId':<?php echo $companyProfileModel->companyId; ?>
            },
            success: function (data) {
                if ((data.errors)) {
                    alert('errors');
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                } else {

                    $('#holidayModal').modal('toggle');
                    $('#holidayName').val(null);

                 var html =  '\
                 <tr id="holiday_' + data.holidayId + ' ">\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.holidayName + '\
                        </div>\
                    </td>\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.startDate + '\
                        </div>\
                    </td>\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.endDate + '\
                        </div>\
                    </td>\
                    <td class="table-text">\
                        <div id="holiday_' + data.holidayId + ' ">\
                            ' + data.holidays + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary btn-lg" \
                        onclick="openHolidayModal(\'' + data.holidayId +'\',\''+ data.holidayName +'\',\''+ data.startDate +'\',\''+ data.endDate +'\');" \
                        type="submit"> \
                        Edit \
                        </button> \
                    </td> \
                    <td >\
                        <button class="btn btn-danger" onclick="deleteHoliday(' + data.holidayId + ')" type="submit"> \
                            <i class="fa fa-trash">DELETE</i> \
                        </button> \
                    </td> \
                    </tr>"\
                    ';
                      //var  jobTitleId="jobTitle_"+data.jobTitleId;
                     $("#holidayTableBody").append(html);
                    //$(jobTitleId).text(data.jobTitle);
                }

            }
                 });


         }
         function deleteHoliday(holidayId) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'DELETE',
            url: '/companyholidays/' + holidayId,
            data: {
                '_token': CSRF_TOKEN,
            },
            success: function (data) {
                if ((data.errors)) {
                    alert('errors');
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                } else {

                   $('#holiday_' + holidayId).remove();


                }
            },
        });
    }

</script>
@endsection