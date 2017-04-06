@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Employee Form -->
        <form action="{{url('employees') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Employee Name -->
            <div class="form-group">
                <label for="employee" class="col-sm-3 control-label">Employee</label>

                <div class="col-sm-6">
                    <input type="text" name="firstName" id="employee-firstName" class="form-control" placeholder="First Name">
                    <input type="text" name="lastName" id="employee-lastName" class="form-control" placeholder="Last Name">
                    <input type="text" name="hireDate" id="employee-hireDate" class="form-control" placeholder="Hire Date">
                    <input type="text" name="terminationDate" id="employee-terminationDate" class="form-control" placeholder="Termination Date">
                    <input type="text" name="jobTitle" id="employee-jobTitle" class="form-control" placeholder="Job Title">
                    <input type="text" name="annualSalary" id="employee-annualSalary" class="form-control" placeholder="Annual Salary">
                    <input type="text" name="hourlyRate" id="employee-hourlyRate" class="form-control" placeholder="Hourly Rate">


                </div>
            </div>

            <!-- Add Employee Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Employee
                    </button>
                </div>
            </div>
        </form>
    </div>
        <!-- Current Employees -->
    @if (count($employees) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
             {{-- display all current employees --}}
                Current Employees
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Employee</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <!-- Employee Name -->
                                <td class="table-text">
                                    <div><b>First Name:</b><i> {{ $employee->firstName }}</div>
                                    <div><b>Last Name  :</b>{{ $employee->lastName }}</div>
                                    <div><b>Job Title  :</b>{{ $employee->jobTitle }}</div>

                                </td>

                                <!-- Delete Button -->
                                <td>
                                 <form action="{{ url('employees/'.$employee->id) }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> EDIT
                                        </button>
                                    </form>
                                    <form action="{{ url('employees/'.$employee->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection