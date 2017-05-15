    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-6">
            <input type="text" name="firstName" id="employee-firstName" class="form-control" @if(isset($editEmployeeModel->firstName)) value="{{ $editEmployeeModel->firstName }}" @else placeholder="First Name" @endif required >
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" name="lastName"  id="employee-lastName" class="form-control" @if(isset($editEmployeeModel->lastName)) value="{{ $editEmployeeModel->lastName }}" @else placeholder="Last Name" @endif  required>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Hire Date</label>
        <div class="col-sm-6">
            <input type="date" name="hireDate" id="employee-hireDate" class="form-control" @if(isset($editEmployeeModel->hireDate)) value="{{ $editEmployeeModel->hireDate }}" @else placeholder="Hire Date" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Termination Date</label>
        <div class="col-sm-6">
            <input type="date" name="terminationDate" id="employee-terminationDate" class="form-control" @if(isset($editEmployeeModel->terminationDate)) value="{{ $editEmployeeModel->terminationDate }}" @else placeholder="Termination Date" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Job Title</label>
        <div class="col-sm-6">

            <input type="text" name="jobTitle" id="employee-jobTitle" class="form-control" @if(isset($editEmployeeModel->jobTitle)) value="{{ $editEmployeeModel->jobTitle }}" @else placeholder="Job Title" @endif>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Annual Salary</label>
        <div class="col-sm-6">
            <input type="number" name="annualSalary" id="employee-annualSalary" class="form-control" @if(isset($employeeModel->annualSalary)) value="{{ $employeeModel->annualSalary }}" @else placeholder="Annual Salary" @endif>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Hourly Rate</label>
        <div class="col-sm-6">
            <input type="number" name="hourlyRate" id="employee-hourlyRate" class="form-control" @if(isset($editEmployeeModel->hourlyRate)) value="{{ $editEmployeeModel->hourlyRate }}" @else placeholder="Hourly Rate" @endif>
        </div>
    </div>
     <div class="form-group">
        <label for="Over time rate" class="col-sm-3 control-label">Over Time Rate</label>
        <div class="col-sm-6">
            <input type="number" step="any" name="overTimeRate" id="employee-overTimeRate" class="form-control" @if(isset($editEmployeeModel->overTime)) value="{{ $editEmployeeModel->overTimeRate }}" @else placeholder="Over Time Rate" @endif>
        </div>
    </div>
        @include('address/addressForm');
    <div class="form-group">
     <label for="name" class="col-sm-3 control-label">Select Department</label>
     {{-- <div class="col-sm-6">
        @if (count($departments) > 0)
        <select class="form-control" name="departmentList[]" multiple="multiple" id="departmentList">
           @foreach ($departments as $department)
           <option  value="{{$department->id}}"
                    id="department_{{$department->name}}"
                    @if(isset($employeeDepartmentIds) && in_array($department->id, $employeeDepartmentIds)) selected="selected" @endif   >{{ $department->name}} </option>
           @endforeach
        </select>
     </div> --}}
       {{--  @endif --}}
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> {{isset($editEmployeeModel)? "Update": "Add"}} Employee
          </button>
        </div>
    </div>