        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">First Name</label>
            <div class="col-sm-6">
                <input type="text" name="firstName" id="employee-firstName" class="form-control" @if(isset($employee)) value="{{ $employee->firstName }}" @else placeholder="First Name" @endif required >
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Last Name</label>
            <div class="col-sm-6">
            <input type="text" name="lastName"  id="employee-lastName" class="form-control" @if(isset($employee)) value="{{ $employee->lastName }}" @else placeholder="Last Name" @endif  required>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Hire Date</label>
            <div class="col-sm-6">
                <input type="date" name="hireDate" id="employee-hireDate" class="form-control" @if(isset($employee)) value="{{ $employee->hireDate }}" @else placeholder="Hire Date" @endif>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Termination Date</label>
            <div class="col-sm-6">
                <input type="date" name="terminationDate" id="employee-terminationDate" class="form-control" @if(isset($employee)) value="{{ $employee->terminationDate }}" @else placeholder="Termination Date" @endif>
       		 </div>
       	</div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Job Title</label>
            <div class="col-sm-6">

                <input type="text" name="jobTitle" id="employee-jobTitle" class="form-control" @if(isset($employee)) value="{{ $employee->jobTitle }}" @else placeholder="Job Title" @endif>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Annual Salary</label>
            <div class="col-sm-6">
                <input type="number" name="annualSalary" id="employee-annualSalary" class="form-control" @if(isset($employee)) value="{{ $employee->annualSalary }}" @else placeholder="Annual Salary" @endif>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Hourly Rate</label>
            <div class="col-sm-6">
                <input type="number" name="hourlyRate" id="employee-hourlyRate" class="form-control" @if(isset($employee)) value="{{ $employee->hourlyRate }}" @else placeholder="Hourly Rate" @endif>
            </div>
        </div>
         <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> {{isset($employee)? "Update": "Add"}} Employee
                </button>
            </div>
        </div>

