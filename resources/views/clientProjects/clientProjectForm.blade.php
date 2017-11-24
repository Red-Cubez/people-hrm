<section class="clientProjectformSection">
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div id="name" class="form-group">
            <label for="clientProject">Name</label>
            <input type="text" name="name" id="name" class="form-control" @if(isset($clientProject))
            value="{{$clientProject->name}}" @else placeholder="Enter Name" @endif   required>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="clientProject">Expected Start Date</label>
            <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control"
                   @if(isset($clientProject)) value="{{$clientProject->expectedStartDate}}"
                   @else placeholder="Enter expected Start Date" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7   ">
        <div class="form-group">
            <label for="clientProject">Expected End Date</label>
            <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control"
                   @if(isset($clientProject))
                   value="{{$clientProject->expectedEndDate}}" @else placeholder="Enter Expected End Date" @endif >
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="clientProject">Actual Start Date</label>
            <input type="date" name="actualStartDate" id="actualStartDate" class="form-control"
                   @if(isset($clientProject))
                   value="{{$clientProject->actualStartDate}}" @else placeholder="Enter Actual Start Date" @endif >
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7   ">
        <div class="form-group">
            <label for="clientProject">Actual End Date</label>
            <input type="date" name="actualEndDate" id="actualEndDate" class="form-control" @if(isset($clientProject))
            value="{{$clientProject->actualEndDate}}" @else placeholder="Enter Actual End Date" @endif>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="clientProject">Budget</label>
            <input type="number" name="budget" id="budget" class="form-control" @if(isset($clientProject))
            value="{{$clientProject->budget}}" @else placeholder="Enter budget" @endif >
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7  ">
        <div class="form-group">
            <label for="clientProject">Cost</label>
            <input type="number" name="cost" id="cost" class="form-control" @if(isset($clientProject))
            value="{{$clientProject->cost}}" @else placeholder="Enter cost" @endif >
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xs-12 col-sm-7   ">
        <div class="form-group">
            <button type="submit" class="btn btn-default">{{isset($clientProject)? "Update": "Add"}} Project</button>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        var projectForm = $('#projectForm');

        projectForm.on('submit', function (env) {
            var action = $('#action').val();

            env.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/clientprojects/validateform',
                data: projectForm.serialize(),
                success: function (data) {

                    if (data.formErrors.hasErrors == false) {
                        //form have no errors
                        submitProjectForm(projectForm, action);
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
                        $("#name").before(html);
                        $(window).scrollTop($('#list').offset().top);
                    }
                },
                error: function () {
                    alert("Bad submit validate");
                }
            });
        });
    });
    function submitProjectForm(projectForm, action) {
        var clientProjectId = $('#clientProjectId').val();

        if (action == 'save') {
            $.ajax({

                type: 'POST',
                url: '/clientprojects/',
                data: projectForm.serialize(),
                success: function (data) {

                    top.location.href = "/clientprojects/" + data.projectId;

                },
                error: function () {
                    alert("Bad submit store");
                }

            });
        }
        if (action == 'update') {
            $.ajax({

                type: 'PUT',
                url: '/clientprojects/' + clientProjectId,
                data: projectForm.serialize(),
                success: function (data) {

                    top.location.href = "/clientprojects/" + clientProjectId;

                },
                error: function () {
                    alert("Bad submit update");
                }

            });
        }
    }

</script>