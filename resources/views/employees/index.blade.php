@extends('layouts.app')
@section('content')
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Employee Form -->
    <!-- New Employee Form -->
    <form action="{{url('employees') }}"
        method="POST"
        class="form-horizontal">
        {{ csrf_field() }}
    @include('employees/employeeForm')

    </form>
</div>
<!-- Current Employees -->
@if (count($employees) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        {{-- display all current employees --}}
        <h3> Current Employees </h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>First Name </th>
                <th>Last Name</th>
                <th>Job Tttle</th>
                <th>Operation</th>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <!-- Employee Name -->
                    <td class="table-text">
                        <div> {{ $employee->firstName }}</div>
                    </td>
                    <td class="table-text">
                        <div> {{ $employee->lastName }}</div>
                    </td>
                    <td class="table-text">
                        <div> {{ $employee->jobTitle }}</div>
                    </td>
                    </td>
                    <!-- Delete Button -->
                    <td>
                        <form action="{{ url('employees/'.$employee->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash">EDIT</i>
                            </button>
                        </form>
                        <form action="{{ url('employees/'.$employee->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">
                            <i c/lass="fa fa-trash">DELETE</i>
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