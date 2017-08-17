@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Employee Form -->
        <!-- New Employee Form -->
        <form id="employeeForm" name="employeeForm" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="companyId" value="{{$companyId}}">
            <input type="hidden" name="action" id="action" value="save">
            @include('employees/employeeForm')

        </form>


    </div>


@endsection