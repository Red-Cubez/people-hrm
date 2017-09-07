@role('admin')
<div id="name" class="form-group">
    <label for="name" class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-6">
        <input type="text" name="firstName" id="firstName" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->firstName)) value="{{ $editEmployeeModel->employeeProfile->firstName }}"
               @else placeholder="First Name" @endif required>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-6">
        <input type="text" name="lastName" id="lastName" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->lastName)) value="{{ $editEmployeeModel->employeeProfile->lastName }}"
               @else placeholder="Last Name" @endif  required>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Date of Birth</label>
    <div class="col-sm-6">
        <input type="date" name="birthDate" id="birthDate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->birthDate)) value="{{ $editEmployeeModel->employeeProfile->birthDate }}"
               @else placeholder="Hire Date" @endif required>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Hire Date</label>
    <div class="col-sm-6">
        <input type="date" name="hireDate" id="hireDate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->hireDate)) value="{{ $editEmployeeModel->employeeProfile->hireDate }}"
               @else placeholder="Hire Date" @endif>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Termination Date</label>
    <div class="col-sm-6">
        <input type="date" name="terminationDate" id="terminationDate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->terminationDate)) value="{{ $editEmployeeModel->employeeProfile->terminationDate }}"
               @else placeholder="Termination Date" @endif>
    </div>
</div>
<div class="form-group">
    <label for="Select Job Title" class="col-sm-3 control-label">Job Title</label>
    <div class="col-sm-6">
        <select class="col-sm-3 " name="jobTitleId" id="jobTitleId" required>
            <option>
                @if(!isset($editEmployeeModel->employeeProfile->jobTitle))

                @endif
            </option>
            @foreach ($jobTitles as $jobTitle)


                <option
                        @if(isset($editEmployeeModel->employeeProfile->jobTitle)&&($jobTitle->title)==$editEmployeeModel->employeeProfile->jobTitle)
                        selected
                        @endif

                        value="{{$jobTitle->id}}" id="jobTitle_{{$jobTitle->title}}">

                    {{$jobTitle->title}}

                </option>

            @endforeach
        </select>

    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Annual Salary</label>
    <div class="col-sm-6">
        <input type="number" name="annualSalary" id="employee-annualSalary" class="form-control"
               @if(isset($employeeModel->employeeProfile->annualSalary)) value="{{ $employeeModel->employeeProfile->annualSalary }}"
               @else placeholder="Annual Salary" @endif>
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Hourly Rate</label>
    <div class="col-sm-6">
        <input type="number" name="hourlyRate" id="employee-hourlyRate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->hourlyRate)) value="{{ $editEmployeeModel->employeeProfile->hourlyRate }}"
               @else placeholder="Hourly Rate" @endif>
    </div>
</div>
<div class="form-group">
    <label for="Over time rate" class="col-sm-3 control-label">Over Time Rate</label>
    <div class="col-sm-6">
        <input type="number" step="any" name="overTimeRate" id="employee-overTimeRate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->overTime)) value="{{ $editEmployeeModel->employeeProfile->overTimeRate }}"
               @else placeholder="Over Time Rate" @endif>
    </div>
</div>

@include('address/addressForm')


<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Select Department</label>
    <div class="col-sm-6">
        @if (count($departments) > 0)
            <select class="form-control" name="departmentList[]" multiple="multiple" id="departmentList">
                @foreach ($departments as $department)
                    <option value="{{$department->id}}"
                            id="department_{{$department->name}}"
                            @if(isset($editEmployeeModel->employeeDepartmentIds) && in_array($department->id, $editEmployeeModel->employeeDepartmentIds)) selected="selected" @endif >{{ $department->name}} </option>
                @endforeach
            </select>
    </div>
    @endif
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($editEmployeeModel)? "Update": "Add"}} Employee
        </button>
    </div>
</div>
@endrole
<script type="text/javascript">

    $(document).ready(function () {
        var employeeForm = $('#employeeForm');

        employeeForm.on('submit', function (env) {
            var action=$('#action').val();

            env.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/employees/validateform',
                data: employeeForm.serialize(),
                success: function (data) {

                    if (data.formErrors.hasErrors == false) {
                        //form have no errors

                        submitEmployeeForm(employeeForm,action);
                    }
                    else if (data.formErrors.hasErrors == true) {

                        var htmlError = '<div id="list" class="alert alert-danger">';
                        if (data.formErrors.firstNameNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.firstNameNotEntered + "</li>";
                        }
                        if (data.formErrors.lastNameNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.lastNameNotEntered + "</li>";
                        }
                        if (data.formErrors.hireDateNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.hireDateNotEntered + "</li>";
                        }
                        if (data.formErrors.wrongHireDate) {
                            htmlError = htmlError + "<li>" + data.formErrors.wrongHireDate + "</li>";
                        }
                        if (data.formErrors.wrongTerminationDate) {
                            htmlError = htmlError + "<li>" + data.formErrors.wrongTerminationDate + "</li>";
                        }
                        
                        if (data.formErrors.jobTitleNotEntered) {
                            htmlError = htmlError + "<li>" + data.formErrors.jobTitleNotEntered + "</li>";
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
    function submitEmployeeForm(employeeForm,action) {

        if(action == 'save') {

            $.ajax({
                type: 'POST',
                url: '/employees/',
                data: employeeForm.serialize(),
                success: function (data) {

                    top.location.href = "/employees/" + data.employeeId;

                },
                error: function () {
                    alert("Bad submit store");
                }

            });
        }
        if (action == 'update') {
            var employeeId=$('#employeeId').val();

            $.ajax({
                type: 'PUT',
                url: '/employees/'+ employeeId,
                data: employeeForm.serialize(),
                success: function (data) {

                    top.location.href = "/employees/" + employeeId;

                },
                error: function () {
                    alert("Bad submit update");
                }

            });
        }
    }

</script>