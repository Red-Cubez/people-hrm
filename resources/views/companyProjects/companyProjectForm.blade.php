<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div id="nameDiv" class="form-group">
    <label for="companyproject"  >Name</label>
    
        <input type="text" name="name" id="name" class="form-control"
               @if(isset($companyproject)) value="{{$companyproject->name}}"
               @else placeholder="Enter Name" @endif
               required>
    
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="companyproject"  >Expected Start Date</label>

    
        <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control"
               @if(isset($companyproject)) value="{{$companyproject->expectedStartDate}}" @else placeholder="Enter expected Start Date" @endif>
    
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="companyproject"  >Expected End Date</label>

    
        <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control" @if(isset($companyproject)) value="{{$companyproject->expectedEndDate}}" @else placeholder="Enter Expected End Date" @endif >
    
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="companyproject"  >Actual Start Date</label>

    
        <input type="date" name="actualStartDate" id="actualStartDate" class="form-control" @if(isset($companyproject)) value="{{$companyproject->actualStartDate}}" @else placeholder="Enter Actual Start Date" @endif >
    
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="companyproject" >Actual End Date</label>

    
        <input type="date" name="actualEndDate" id="actualEndDate" class="form-control" @if(isset($companyproject)) value="{{$companyproject->actualEndDate}}" @else placeholder="Enter Actual End Date" @endif>
   
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="companyproject" >Budget</label>

    
        <input type="number" name="budget" id="budget" class="form-control" @if(isset($companyproject->budget)) value="{{$companyproject->budget}}" @else placeholder="Enter budget" @endif >
     
</div>
</div>
</div>
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    <label for="companyproject" >Cost</label>

    
        <input type="number" name="cost" id="cost" class="form-control" @if(isset($companyproject->cost)) value="{{$companyproject->cost}}" @else placeholder="Enter cost" @endif >
    
</div>
</div>
</div>
<!-- Add companyproject Button -->
<div class="row ">
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 ">
<div class="form-group">
    
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($companyproject)? "Update": "Add"}} Project
        </button>
   
</div>
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