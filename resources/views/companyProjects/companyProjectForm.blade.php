
<div id="nameDiv" class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-6">
        <input type="text" name="name" id="name" class="form-control"
               @if(isset($companyproject)) value="{{$companyproject->name}}"
               @else placeholder="Enter Name" @endif
               required>
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Expected Start Date</label>

    <div class="col-sm-6">
        <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control"
               @if(isset($companyproject)) value="{{$companyproject->expectedStartDate}}" @else placeholder="Enter expected Start Date" @endif>
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Expected End Date</label>

    <div class="col-sm-6">
        <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control" @if(isset($companyproject)) value="{{$companyproject->expectedEndDate}}" @else placeholder="Enter Expected End Date" @endif >
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Actual Start Date</label>

    <div class="col-sm-6">
        <input type="date" name="actualStartDate" id="actualStartDate" class="form-control" @if(isset($companyproject)) value="{{$companyproject->actualStartDate}}" @else placeholder="Enter Actual Start Date" @endif >
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Actual End Date</label>

    <div class="col-sm-6">
        <input type="date" name="actualEndDate" id="actualEndDate" class="form-control" @if(isset($companyproject)) value="{{$companyproject->actualEndDate}}" @else placeholder="Enter Actual End Date" @endif>
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Budget</label>

    <div class="col-sm-6">
        <input type="number" name="budget" id="budget" class="form-control" @if(isset($companyproject->budget)) value="{{$companyproject->budget}}" @else placeholder="Enter budget" @endif >
    </div>
</div>
<div class="form-group">
    <label for="companyproject" class="col-sm-3 control-label">Cost</label>

    <div class="col-sm-6">
        <input type="number" name="cost" id="cost" class="form-control" @if(isset($companyproject->cost)) value="{{$companyproject->cost}}" @else placeholder="Enter cost" @endif >
    </div>
</div>
<!-- Add companyproject Button -->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($companyproject)? "Update": "Add"}} Project
        </button>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        var projectForm = $('#projectForm');

        projectForm.on('submit', function (env) {
            var action=$('#action').val();

            env.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/companyprojects/validateform',
                data: projectForm.serialize(),
                success: function (data) {
                     
                    if (data.formErrors.hasErrors == false) {
                        submitProjectForm(projectForm,action);
                    }
                    else if (data.formErrors.hasErrors == true) {
                       
                        var htmlError = '<div id="list" class="alert alert-danger">';
                        if (data.formErrors.nameNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.nameNotEntered + "</li>";
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
                        $("#nameDiv").before(html);
                        $(window).scrollTop($('#list').offset().top);
                    }
                },
                error: function () {
                    alert("Bad submit validate");
                }
            });
        });
    });
    function submitProjectForm(projectForm,action) {
        var companyProjectId=$('#companyProjectId').val();
        
        if(action == 'save') {
            $.ajax({

                type: 'POST',
                url: '/companyprojects/',
                data: projectForm.serialize(),
                success: function (data) {

                    top.location.href = "/companyprojects/" + data.projectId;

                },
                error: function () {
                    alert("Bad submit store/update");
                }

            });
        }
            if (action == 'update') {
                $.ajax({

                    type: 'PUT',
                    url: '/companyprojects/'+ companyProjectId,
                    data: projectForm.serialize(),
                    success: function (data) {

                        top.location.href = "/companyprojects/" + data.projectId;

                    },
                    error: function () {
                        alert("Bad submit store/update");
                    }

                });
            }
        }

</script>