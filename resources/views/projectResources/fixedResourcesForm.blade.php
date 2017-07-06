@if (isset($formErrors))

    <div class="alert alert-danger">
        <ul>

            @if(isset($formErrors->employeeNotSelected))
                <li>{{ $formErrors->employeeNotSelected}}</li>
            @endif
            @if(isset($formErrors->startDateNotEntered))
                <li>{{ $formErrors->startDateNotEntered}}</li>
            @endif
            @if(isset($formErrors->endDateNotEntered))
                <li>{{$formErrors->endDateNotEntered}}</li>
            @endif
            @if(isset($formErrors->wrongEndDate))
                <li>{{$formErrors->wrongEndDate}}</li>
            @endif

        </ul>
    </div>
@endif
<div id="main" class="form-group">
    <label class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">

        <input type="text" name="title" id="title" class="form-control"
               @if(isset($projectresources[0]->title))
               value="{{$projectresources[0]->title}}"
               @else placeholder="Enter title"
               @endif class="form-control"
               required>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Expected Start date</label>
    <div class="col-sm-10">
        <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources[0]->expectedStartDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Expected End date</label>
    <div class="col-sm-10">
        <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources[0]->expectedEndDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Actual Start date</label>
    <div class="col-sm-10">
        <input type="date" name="actualStartDate" id="actualStartDate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources[0]->actualStartDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Actual End date</label>
    <div class="col-sm-10">
        <input type="date" name="actualEndDate" id="actualEndDate" class="actualEndDate" class="form-control"
               @if(isset($projectresources)) value="{{$projectresources[0]->actualEndDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Hourly billing Rate</label>
    <div class="col-sm-10">
        <input type="Number" name="hourlyBillingRate" id="hourlyBillingRate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources[0]->hourlyBillingRate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Hours Per week</label>
    <div class="col-sm-10">
        <input type="Number" name="hoursPerWeek" id="hoursPerWeek" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources[0]->hoursPerWeek}}" @endif>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
        <button type="submit" class="btn btn-danger">
            {{--<input type="hidden" name="formSubmitted" value="true">--}}
            @if(isset($projectresources))
                <i class="fa fa-trash"> Update </i>
                <input type="hidden" name="projectResourceId" value="{{ $projectresources[0]->id}}"
                       class="form-control">
                <input type="hidden" name="companyProjectId"
                       value="{{ $projectresources[0]->company_project_id}}" class="form-control">
                <input type="hidden" name="clientProjectid"
                       value="{{ $projectresources[0]->client_project_id}}">
            @else
                <i class="fa fa-trash"> Add</i>
        </button>
        @endif
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        var resourceForm = $('#resourceForm');

        resourceForm.on('submit', function (env) {

            env.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/companyprojectresources/validateform',
                data: resourceForm.serialize(),
                success: function (data) {

                    if (data.formErrors.hasErrors == false) {
                        //form have no errors

                        submitResourceForm(resourceForm);
                    }
                    else if (data.formErrors.hasErrors == true) {

                        alert("form have errors");

                        var htmlError='';
                        if(abc)
                        {
                            htmlError = htmlError + "<li>"+ "</li>";
                        }


                        var html = '\
                             <div class="alert alert-danger">\
                             <ul>\
                              <li> </li>\
                                <li></li>\
                        <li></li>\
                            <li></li>\
                        </ul>\
                        </div>';

                        $("#main").before(html);
                    }
                },
                error: function () {
                    alert("Bad submit");
                }
            });
        });
    });
    function submitResourceForm(resourceForm) {

        $.ajax({
            type: 'POST',
            url: '/companyprojectresources/',
            data: resourceForm.serialize(),
            success: function (data) {
                top.location.href = "/companyprojects/" + data.projectId;

            },
            error: function () {
                alert("Bad submit");
            }
        });
    }


    //
    //                        var html = '\
    //
    //<td id="holidayName_' + data.holidayId + ' " class="table-text">\
    //    //
    //    <div>\
    //        // ' + data.holidayName + '\
    //        //
    //    </div>
    //    \
    //    //
    //</td>\
    ////
    //<td id="startDate_' + data.holidayId + ' " class="table-text">\
    //    //
    //    <div>\
    //        // ' + data.startDate + '\
    //        //
    //    </div>
    //    \
    //    //
    //</td>\
    ////
    //<td id="endDate_' + data.holidayId + ' " class="table-text">\
    //    //
    //    <div>\
    //        // ' + data.endDate + '\
    //        //
    //    </div>
    //    \
    //    //
    //</td>\
    ////
    //<td id="countHolidays_' + data.holidayId + ' " class="table-text">\
    //    //
    //    <div>\
    //        // ' + data.holidays + '\
    //        //
    //    </div>
    //    \
    //    //
    //</td>\
    ////
    //<td>\
    //    //
    //    <button \
    //    // class="btn btn-primary" \
    //    // onclick="openHolidayModal(\'' + data.holidayId + '\',\'' + data.holidayName + '\',\'' + data.startDate + '\',\''
    //    + data.endDate + '\');" \
    //    // type="button"> \
    //    // Edit \
    //    //                        </button> \
    //    //
    //</td> \
    ////
    //<td>\
    //    //
    //    <button class="btn btn-danger" onclick="deleteHoliday(' + data.holidayId + ')" type="submit"> \
    //        // <i class="fa fa-trash">DELETE</i> \
    //        //
    //    </button>
    //    \
    //    //
    //</td>';
    ////                        // $('#holiday_' + data.holidayId)
    ////                        // $("#holidayTableBody").append(html);
    ////                        $('#holiday_' + data.holidayId).html(html);
    ////                    }
    ////                },
    ////            });
    ////        }

</script>