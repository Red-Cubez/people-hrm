<div class="form-group">
    <label for="name" class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-6">
        <input type="text" name="firstName" id="employee-firstName" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->firstName)) value="{{ $editEmployeeModel->employeeProfile->firstName }}"
               @else placeholder="First Name" @endif required>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-6">
        <input type="text" name="lastName" id="employee-lastName" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->lastName)) value="{{ $editEmployeeModel->employeeProfile->lastName }}"
               @else placeholder="Last Name" @endif  required>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Hire Date</label>
    <div class="col-sm-6">
        <input type="date" name="hireDate" id="employee-hireDate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->hireDate)) value="{{ $editEmployeeModel->employeeProfile->hireDate }}"
               @else placeholder="Hire Date" @endif>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-3 control-label">Termination Date</label>
    <div class="col-sm-6">
        <input type="date" name="terminationDate" id="employee-terminationDate" class="form-control"
               @if(isset($editEmployeeModel->employeeProfile->terminationDate)) value="{{ $editEmployeeModel->employeeProfile->terminationDate }}"
               @else placeholder="Termination Date" @endif>
    </div>
</div>
<div class="form-group">
    <label for="Select Job Title" class="col-sm-3 control-label">Job Title</label>
    <div class="col-sm-6">
        <select class="col-sm-3 " name="jobTitleId" id="jobTitleId" required="required">
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