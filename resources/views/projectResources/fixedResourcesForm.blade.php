
<div id="main" class="form-group">
    <label class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">

        <input type="text" name="title" id="title" class="form-control"
               @if(isset($projectresources->title))
               value="{{$projectresources->title}}"
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
               @if(isset($projectresources)) value="{{$projectresources->expectedStartDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Expected End date</label>
    <div class="col-sm-10">
        <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources->expectedEndDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Actual Start date</label>
    <div class="col-sm-10">
        <input type="date" name="actualStartDate" id="actualStartDate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources->actualStartDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Actual End date</label>
    <div class="col-sm-10">
        <input type="date" name="actualEndDate" id="actualEndDate" class="actualEndDate" class="form-control"
               @if(isset($projectresources)) value="{{$projectresources->actualEndDate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Hourly billing Rate</label>
    <div class="col-sm-10">
        <input type="Number" name="hourlyBillingRate" id="hourlyBillingRate" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources->hourlyBillingRate}}" @endif>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Hours Per week</label>
    <div class="col-sm-10">
        <input type="Number" name="hoursPerWeek" id="hoursPerWeek" class="form-control"
               class="form-control"
               @if(isset($projectresources)) value="{{$projectresources->hoursPerWeek}}" @endif>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
        <button type="submit" class="btn btn-danger">
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
