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
                    <input type="text" name="firstName" id="employee-firstName" class="form-control">
                    <input type="text" name="lastName" id="employee-lastName" class="form-control">
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
                                    <div>{{ $employee->firstName }}</div>
                                    <div>{{ $employee->lastName }}</div>
                                </td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('employees/'.$employee->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_method" value="DELETE">
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