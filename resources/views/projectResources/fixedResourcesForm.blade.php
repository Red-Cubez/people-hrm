<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div id="main" class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" @if(isset($projectresources->title))
            value="{{$projectresources->title}}" @else placeholder="Enter title" @endif class="form-control" required>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="expectedStartDate">Expected Start date</label>
            <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control" class="form-control"
                   @if(isset($projectresources)) value="{{$projectresources->expectedStartDate}}" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="expectedEndDate">Expected End date</label>
            <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control" class="form-control"
                   @if(isset($projectresources)) value="{{$projectresources->expectedEndDate}}" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="actualStartDate">Actual Start date</label>
            <input type="date" name="actualStartDate" id="actualStartDate" class="form-control" class="form-control"
                   @if(isset($projectresources)) value="{{$projectresources->actualStartDate}}" @endif>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-7 ">
        <div class="form-group">
            <label for="actualEndDate">Actual End date</label>
            <input type="date" name="actualEndDate" id="actualEndDate" class="form-control"
                   @if(isset($projectresources)) value="{{$projectresources->actualEndDate}}" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="hourlyBillingRate">Hourly billing Rate</label>
            <input type="Number" name="hourlyBillingRate" id="hourlyBillingRate" class="form-control"
                   class="form-control"
                   @if(isset($projectresources)) value="{{$projectresources->hourlyBillingRate}}" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="hoursPerWeek">Hours Per week</label>
            <input type="Number" name="hoursPerWeek" id="hoursPerWeek" class="form-control" class="form-control"
                   @if(isset($projectresources)) value="{{$projectresources->hoursPerWeek}}" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7 col-sm-offset-5 ">
        <div class="form-group">
            <button type="submit" class="button button40">
                {{--<input type="hidden" name="formSubmitted" value="true">--}}
                @if(isset($projectresources))
                    <i class="fa fa-trash"> Update </i>
                    <input type="hidden" name="projectResourceId" value="{{ $projectresources->id}}"
                           class="form-control">
                    <input type="hidden" name="companyProjectId"
                           value="{{ $projectresources->company_project_id}}" class="form-control">
                    <input type="hidden" name="clientProjectid"
                           value="{{ $projectresources->client_project_id}}">
                @else
                     Add
            </button>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        var resourceForm = $('#resourceForm');
        resourceForm.on('submit', function (env) {
            env.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/projectresources/validateform',
                data: resourceForm.serialize(),
                success: function (data) {

                    if (data.formErrors.hasErrors == false) {

                        submitResourceForm(resourceForm);
                    }
                    else if (data.formErrors.hasErrors == true) {

                        var htmlError = '<div id="list" class="alert alert-danger">';
                        if (data.formErrors.typeOfResourceNotSelected) {
                            htmlError = htmlError + "<li>" + data.formErrors.typeOfResourceNotSelected + "</li>";
                        }
                        if (data.formErrors.employeeNotSelected) {
                            htmlError = htmlError + "<li>" + data.formErrors.employeeNotSelected + "</li>";
                        }
                        if (data.formErrors.titleNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.titleNotEntered + "</li>";
                        }

                        if (data.formErrors.startDateNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.startDateNotEntered + "</li>";
                        }
                        if (data.formErrors.endDateNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.endDateNotEntered + "</li>";
                        }
                        if (data.formErrors.wrongEndDate) {
                            htmlError = htmlError + "<li>" + data.formErrors.wrongEndDate + "</li>";
                        }


                        html = htmlError;
                        $("#list").remove();
                        $("#main").before(html);
                        $(window).scrollTop($('#list').offset().top);
                    }
                },
                error: function () {
                    alert("Bad submit validate");
                }
            });
        });
    });
    function submitResourceForm(resourceForm) {
        $("#list").remove();
        $.ajax({
            type: 'POST',

            url: '/projectresources/',

            data: resourceForm.serialize(),
            success: function (data) {
                top.location.href = data.redirectTo;
            },

            error: function () {
                alert("Bad submit store/update");
            }
        });
    }


</script>
