<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">
        <div class="scroll-panel-table table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
              <th> Holiday Name</th>
                <th >Start Date</th>
                <th >End Date</th>
               <th > Total Holidays</th>  @permission(StandardPermissions::createEditDeleteHoliday)
              <th ></th>  @endpermission
            </tr>
          </thead>
        <tbody id="holidayTableBody">
            @if (count($companyProfileModel->companyHolidays) > 0)
                @foreach ($companyProfileModel->companyHolidays as $companyHoliday)
                    <tr id="holiday_{{$companyHoliday->holidayId}}">
                        <td id="holidayName_{{$companyHoliday->holidayId}}">
                            {{ $companyHoliday->holidayName }}
                        </td>
                        <td id="startDate_{{$companyHoliday->holidayId}}" >
                            {{ $companyHoliday->startDate }}
                        </td>
                        <td id="endDate_{{$companyHoliday->holidayId}}" >
                            {{ $companyHoliday->endDate }}
                        </td>
                        <td id="countHolidays_{{$companyHoliday->holidayId}}" >
                            {{ $companyHoliday->countHolidays }}
                        </td>
            @permission(StandardPermissions::createEditDeleteHoliday)
                        <td >
                            <div class="aParent">
                                <button class="button20"
                                    onclick="openHolidayModal({{$companyHoliday->holidayId}},null,null,null);"
                                    type="button">
                                <i class="fa fa-pencil-square-o fa-2x"></i>
                            </button>    
                                <form  action="{{url('companyholidays/'.$companyHoliday->holidayId) }}" method="POST" >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="button20 test-flex" data-toggle="confirmation" data-singleton="true">
                                         <i class="fa fa-trash fa-2x"></i>
                                    </button>
                            </form>    
                            </div>
                        </td>
            @endpermission
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        </div>
    @permission(StandardPermissions::createEditDeleteHoliday)
    <div class="padTop20">
       <button class="button button40 pull-right " onclick="openHolidayModal(null,null,null,null);" type="button">
        Add Holiday
    </button>   
    </div>
   </div>
     </div>
@endpermission
@permission(StandardPermissions::createEditDeleteHoliday)
    @include('companyHolidays/companyHolidayModal')
@endpermission
@section('page-scripts')
    @parent
    <script type="text/javascript">

        function initializeHolidayModal() {
            $("#list").remove();
            $('#toBeUpdatedHoliday').val(null);
             $('#holidayModalForm')[0].reset();
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
            return 1;
        }
        function addUpdateHoliday() {

            var areDatesValid = this.areDatesValid();

            if (areDatesValid) {
                var form = $("#holidayModalForm");

                if (form.valid()) {

                    var holidayId = $('#toBeUpdatedHoliday').val();

                    if (holidayId == '' || holidayId === null) {
                        addHoliday();
                    }
                    else {
                        updateHoliday();
                    }
                }
           }
            else if(!areDatesValid) {
                $("#list").remove();
                var endDateIsLessHtml = '<div id="list" class="alert alert-danger">End Date Can not be Less Than Start Date </div>';

                $("#holidayNameDiv").before(endDateIsLessHtml);
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
                    }
                     if(data.formErrors.hasErrors)
                    {
                        var htmlError = '<div id="list" class="alert alert-danger">';
                        if (data.formErrors.nameNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.nameNotEntered + "</li>";
                        }
                        if (data.formErrors.startDateNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.startDateNotEntered + "</li>";
                        }
                         if (data.formErrors.endDateIsLessThanStartDate) {
                            htmlError = htmlError + "<li>" + data.formErrors.endDateIsLessThanStartDate + "</li>";
                        }
                        
                        html = htmlError;
                        $("#list").remove();
                        $("#holidayNameDiv").before(html);

                    }
                     else {

                        $('#holidayModal').modal('toggle');

                        $('#holidayName').val(null);
                        $('#holidayId').val(null);
                        $('#holidayName_' + holidayId).text(data.jobTitle);
                        $('.error').remove();

                        var html = createHtmlRow(data);
                        $('#holiday_' + data.holidayId).html(html);

                        initializeConfirmationBox();
                    }
                },
            });
        }

        function createHtmlRow(data)
      {
           return '\
              <td id="holidayName_' + data.holidayId + ' "  >\
                        <div >\
                            ' + data.holidayName + '\
                        </div>\
                    </td>\
                    <td id="startDate_' + data.holidayId + ' " ">\
                        <div >\
                            ' + data.startDate + '\
                        </div>\
                    </td>\
                    <td id="endDate_' + data.holidayId + ' " ">\
                        <div  >\
                            ' + data.endDate + '\
                        </div>\
                    </td>\
                    <td id="countHolidays_' + data.holidayId + ' " >\
                        <div >\
                            ' + data.holidays + '\
                        </div>\
                    </td>\
                    <td >\
                     <div class="aParent">\
                        <button \
                        class="button20" \
                        onclick="openHolidayModal(\'' + data.holidayId + '\',\'' + data.holidayName + '\',\'' + data.startDate + '\',\'' + data.endDate + '\');" \
                        type="button"> \
                       <i class="fa fa-pencil-square-o fa-2x"></i> \
                        </button> \
                          <form action="{{url('companyholidays')}}/' + data.holidayId + ' " method="POST">\
                                    {{ csrf_field() }}\
                                    {{ method_field('DELETE') }}\
                                    <button type="submit" class="button20 test-flex" data-toggle="confirmation"\ data-singleton="true">\
                                        <i class="fa fa-trash fa-2x"></i>\
                                    </button>\
                            </form>\
                           </div>\
                    </td>';
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
                    }
                    if(data.formErrors.hasErrors)
                    {
                        var htmlError = '<div id="list" class="alert alert-danger">';
                        if (data.formErrors.nameNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.nameNotEntered + "</li>";
                        }
                        if (data.formErrors.startDateNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.startDateNotEntered + "</li>";
                        }
                         if (data.formErrors.endDateIsLessThanStartDate) {
                            htmlError = htmlError + "<li>" + data.formErrors.endDateIsLessThanStartDate + "</li>";
                        }
                        
                        html = htmlError;
                        $("#list").remove();
                        $("#holidayNameDiv").before(html);
                        // $(window).scrollTop($('#list').offset().top);
                    }
                     else {

                        $('#holidayModal').modal('toggle');
                        $('#holidayName').val(null);

                        var html = '\
                 <tr id="holiday_' + data.holidayId + '">\
                    '+ createHtmlRow(data);
                    '\
                    </tr>"\
                    ';
                        $("#holidayTableBody").append(html);
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
