
    <div id="name" class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control" @if(isset($clientProject))
            value="{{$clientProject->name}}"  @else placeholder="Enter Name" @endif   required>
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Expected Start Date</label>

        <div class="col-sm-6">
            <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control"
            @if(isset($clientProject)) value="{{$clientProject->expectedStartDate}}" @else placeholder="Enter expected Start Date" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Expected End Date</label>

        <div class="col-sm-6">
            <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control" @if(isset($clientProject)) value="{{$clientProject->expectedEndDate}}" @else placeholder="Enter Expected End Date" @endif >
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Actual Start Date</label>

        <div class="col-sm-6">
            <input type="date" name="actualStartDate" id="actualStartDate" class="form-control" @if(isset($clientProject)) value="{{$clientProject->actualStartDate}}" @else placeholder="Enter Actual Start Date" @endif >
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Actual End Date</label>

        <div class="col-sm-6">
            <input type="date" name="actualEndDate" id="actualEndDate" class="form-control" @if(isset($clientProject)) value="{{$clientProject->actualEndDate}}" @else placeholder="Enter Actual End Date" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Budget</label>

        <div class="col-sm-6">
            <input type="number" name="budget" id="budget" class="form-control" @if(isset($clientProject)) value="{{$clientProject->budget}}" @else placeholder="Enter budget" @endif >
        </div>
    </div>
    <div class="form-group">
        <label for="clientProject" class="col-sm-3 control-label">Cost</label>

        <div class="col-sm-6">
            <input type="number" name="cost" id="cost" class="form-control" @if(isset($clientProject)) value="{{$clientProject->cost}}" @else placeholder="Enter cost" @endif >
        </div>
    </div>
          <!-- Add clientProject Button -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> {{isset($clientProject)? "Update": "Add"}} Project
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
                    url: '/clientprojects/validateform',
                    data: projectForm.serialize(),
                    success: function (data) {

                        if (data.formErrors.hasErrors == false) {
                            //form have no errors
                            submitProjectForm(projectForm,action);
                        }
                        else if (data.formErrors.hasErrors == true) {

                            var htmlError = '<div id="list" class="alert alert-danger">';

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
                        }
                    },
                    error: function () {
                        alert("Bad submit validate");
                    }
                });
            });
        });
        function submitProjectForm(projectForm,action) {
            var clientProjectId=$('#clientProjectId').val();

            if(action == 'save') {
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
                    url: '/clientprojects/'+ clientProjectId,
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