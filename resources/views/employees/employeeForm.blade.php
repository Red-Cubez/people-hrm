<article class="employeeForm">
    @permission(StandardPermissions::createEditEmployee)
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div id="name" class="form-group">
                <label for="name">First Name</label>
                <input type="text" name="firstName" id="firstName" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->firstName))
                       value="{{ $editEmployeeModel->employeeProfile->firstName }}"
                       @else placeholder="First Name" @endif required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->lastName))
                       value="{{ $editEmployeeModel->employeeProfile->lastName }}"
                       @else placeholder="Last Name" @endif  required>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="name">Date of Birth</label>
                <input type="date" name="birthDate" id="birthDate" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->birthDate))
                       value="{{ $editEmployeeModel->employeeProfile->birthDate }}"
                       @else placeholder="Hire Date" @endif required>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="name">Hire Date</label>
                <input type="date" name="hireDate" id="hireDate" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->hireDate))
                       value="{{ $editEmployeeModel->employeeProfile->hireDate }}"
                       @else placeholder="Hire Date" @endif required>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="name">Termination Date</label>
                <input type="date" name="terminationDate" id="terminationDate" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->terminationDate))
                       value="{{ $editEmployeeModel->employeeProfile->terminationDate }}"
                       @else placeholder="Termination Date" @endif>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7  ">
            <div class="form-group">
                <label for="Select Job Title">Job Title</label>
                <select name="jobTitleId" id="jobTitleId" required class="form-control">
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
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7  ">
            <div class="form-group">
                <label for="name">Annual Salary</label>
                <input type="number" name="annualSalary" id="employee-annualSalary" class="form-control"
                       @if(isset($employeeModel->employeeProfile->annualSalary))
                       value="{{ $employeeModel->employeeProfile->annualSalary }}"
                       @else placeholder="Annual Salary" @endif>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="name">Hourly Rate</label>
                <input type="number" name="hourlyRate" id="employee-hourlyRate" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->hourlyRate)) value="{{ $editEmployeeModel->employeeProfile->hourlyRate }}"
                       @else placeholder="Hourly Rate" @endif>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="Over time rate">Over Time Rate</label>
                <input type="number" step="any" name="overTimeRate" id="employee-overTimeRate" class="form-control"
                       @if(isset($editEmployeeModel->employeeProfile->overTime))
                       value="{{ $editEmployeeModel->employeeProfile->overTimeRate }}"
                       @else placeholder="Over Time Rate" @endif>
            </div>
        </div>
    </div>
    @include('address/addressForm')
    <div class="row ">
        <div class="col-xs-12 col-sm-7   ">
            <div class="form-group">
                <label for="name">Select Department</label>
                @if (count($departments) > 0)
                    <select class="form-control" name="departmentList[]" multiple="multiple" id="departmentList">
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}"
                                    id="department_{{$department->name}}"
                                    @if(isset($editEmployeeModel->employeeDepartmentIds) && in_array($department->id, $editEmployeeModel->employeeDepartmentIds)) selected="selected" @endif >{{ $department->name}} </option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row-content100">
            <div class="col-xs-12 col-sm-3 col-sm-offset-4">
                <div class="form-group">
                    <button type="submit" class="button button40">
                        {{isset($editEmployeeModel)? "Update": "Add"}} Employee
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endpermission
</article>
<script type="text/javascript">

    $(document).ready(function () {
        var employeeForm = $('#employeeForm');

        employeeForm.on('submit', function (env) {
            var action = $('#action').val();

            env.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/employees/validateform',
                data: employeeForm.serialize(),
                success: function (data) {

                    if (data.formErrors.hasErrors == false) {
                        //form have no errors

                        submitEmployeeForm(employeeForm, action);
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
    function submitEmployeeForm(employeeForm, action) {

        if (action == 'save') {

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
            var employeeId = $('#employeeId').val();

            $.ajax({
                type: 'PUT',
                url: '/employees/' + employeeId,
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