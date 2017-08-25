<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">

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
            @if (count($companyProfileModel->companyHolidays) > 0)
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
                        <td id="endDate_{{$companyHoliday->holidayId}}" class="table-text">
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
                            <button class="btn btn-primary"
                                    onclick="openHolidayModal({{$companyHoliday->holidayId}},null,null,null);"
                                    type="button">
                                <i class="">
                                    Edit
                                </i>
                            </button>

                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteHoliday({{$companyHoliday->holidayId}})"
                                    type="button">
                                <i class="fa fa-trash">
                                    Delete
                                </i>
                            </button>
                        </td>
                    </tr>
                @endforeach

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
    @parent
    <script type="text/javascript">

        function initializeHolidayModal() {
            $("#list").remove();
            $('#holidayName').val(null);
            $('#startDate').val(null);
            $('#endDate').val(null);
            $("#startDateNotEnteredDiv").remove();
            $("#nameNotEnteredDiv").remove();
            //$('#jobTitleId').val(null);
            $('#toBeUpdatedHoliday').val(null);
        }
        function setupHolidayEditValues(holidayId, holidayName, startDate, endDate) {

            if (holidayName == null) {
                var holidayNameValue = $('#holidayName_' + holidayId).text().trim();
                var startDate = $('#startDate_' + holidayId).text().trim();
                var endDate = $('#endDate_' + holidayId).text().trim();

            }
            else {
                var holidayNameValue = holidayName;
                var startDate = startDate;
                var endDate = endDate;

            }

            $("#holidayName").val(holidayNameValue);
            $("#startDate").val(startDate);
            $("#endDate").val(endDate);
        }
        function openHolidayModal(holidayId, holidayName, startDate, endDate) {
            initializeHolidayModal();

            if (holidayId !== null) {
                $('#toBeUpdatedHoliday').val(holidayId);
                setupHolidayEditValues(holidayId, holidayName, startDate, endDate);
                $('#addUpdateHolidayButton').html('Update Holiday');
            }
            else {
                $('#addUpdateHolidayButton').html('Add Holiday');
            }
            $('#holidayModal').modal('show');
        }

        function areDatesValid() {
            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            if (endDate == '') {
                if (startDate != '')
                {
                    return true;
                }
                return true;
            }
            if (endDate < startDate) {
                return false;
            }
            if(startDate=='' || startDate==null)
            {
            return 1;
        }
        }
        function isHolidayNameEntered()
        {
            holidayName=$('#holidayName').val();

            if(holidayName=='' || holidayName==null)
            {
                return false;
            }
            else if(holidayName!=null || holidayName!='')
            {
                return true;
            }
        }
        function addUpdateHoliday() {

            var areDatesValid = this.areDatesValid();
            var isHolidayNameEntered=this.isHolidayNameEntered();
            if (areDatesValid) {
                 $("#nameNotEnteredDiv").remove();
                 $("#startDateNotEnteredDiv").remove();
                var form = $("#holidayModalForm");

                if (form.valid()) {
                     if(isHolidayNameEntered)
                    {

                    var holidayId = $('#toBeUpdatedHoliday').val();

                    if (holidayId == '' || holidayId === null) {
                        addHoliday();
                    }
                    else {
                        updateHoliday();
                    }
                }
                }
            }
             if(!isHolidayNameEntered)
            {
                $("#nameNotEnteredDiv").remove();
               
                var html = '<div id="nameNotEnteredDiv" class="alert alert-danger">Please Enter Holiday Name </div>';

                $("#holidayNameDiv").before(html);
                $(window).scrollTop($('#nameNotEnteredDiv').offset().top);

            }
            if(areDatesValid==1)
            {
                $("#startDateNotEnteredDiv").remove();
                var html = '<div id="startDateNotEnteredDiv" class="alert alert-danger">Please Entered Start Date </div>';

                $("#holidayNameDiv").before(html);
                $(window).scrollTop($('#startDateNotEnteredDiv').offset().top);
            }
            if(!areDatesValid) {
                $("#list").remove();
                var html = '<div id="list" class="alert alert-danger">End Date Can not be Smaller Than Start Date </div>';

                $("#holidayNameDiv").before(html);
                  $(window).scrollTop($('#list').offset().top);

              //  alert(wrongEndDate);
                //alert("Enter Corrrect End Date");
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
                    'startDate': startDate,
                    'endDate': endDate,
                },
                success: function (data) {
                    if ((data.errors)) {
                        alert('errors');
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                    } else {

                        // $('#holiday_' + data.holidayId).remove();
                        $('#holidayModal').modal('toggle');

                        $('#holidayName').val(null);
                        $('#holidayId').val(null);
                        $('#holidayName_' + holidayId).text(data.jobTitle);
                        $('.error').remove();

                        var html = '\
                     <td id="holidayName_' + data.holidayId + ' " class="table-text" >\
                        <div >\
                            ' + data.holidayName + '\
                        </div>\
                    </td>\
                    <td id="startDate_' + data.holidayId + ' " class="table-text">\
                        <div >\
                            ' + data.startDate + '\
                        </div>\
                    </td>\
                    <td id="endDate_' + data.holidayId + ' " class="table-text">\
                        <div >\
                            ' + data.endDate + '\
                        </div>\
                    </td>\
                    <td id="countHolidays_' + data.holidayId + ' " class="table-text">\
                        <div >\
                            ' + data.holidays + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary" \
                        onclick="openHolidayModal(\'' + data.holidayId + '\',\'' + data.holidayName + '\',\'' + data.startDate + '\',\'' + data.endDate + '\');" \
                        type="button"> \
                        Edit \
                        </button> \
                    </td> \
                    <td >\
                        <button class="btn btn-danger" onclick="deleteHoliday(' + data.holidayId + ')" type="submit"> \
                            <i class="fa fa-trash">DELETE</i> \
                        </button> \
                    </td>';
                        // $('#holiday_' + data.holidayId)
                        // $("#holidayTableBody").append(html);
                        $('#holiday_' + data.holidayId).html(html);
                    }
                },
            });
        }

        function addHoliday() {

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
                    'startDate': startDate,
                    'endDate': endDate,

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

                        var html = '\
                 <tr id="holiday_' + data.holidayId + '">\
                    <td id="holidayName_' + data.holidayId + ' " class="table-text">\
                        <div>\
                            ' + data.holidayName + '\
                        </div>\
                    </td>\
                    <td id="startDate_' + data.holidayId + ' " class="table-text">\
                        <div>\
                            ' + data.startDate + '\
                        </div>\
                    </td>\
                    <td id="endDate' + data.holidayId + ' " class="table-text">\
                        <div>\
                            ' + data.endDate + '\
                        </div>\
                    </td>\
                    <td id="countHolidays_' + data.holidayId + ' " class="table-text">\
                        <div>\
                            ' + data.holidays + '\
                        </div>\
                    </td>\
                    <td >\
                        <button \
                        class="btn btn-primary " \
                        onclick="openHolidayModal(\'' + data.holidayId + '\',\'' + data.holidayName + '\',\'' + data.startDate + '\',\'' + data.endDate + '\');" \
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
                        $("#holidayTableBody").append(html);
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