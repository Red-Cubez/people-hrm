@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Employee Form -->
        <!-- New Employee Form -->
        <form  action="{{url('roles') }}"  name="employeeForm" class="form-horizontal" method="POST">
            {{ csrf_field() }}
   
            @include('role/roleForm')

        </form>


    </div>


@endsection