@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Employee Form -->
        <!-- New Employee Form -->
        <form  action="{{url('user-roles/'.$user->id) }}"  name="employeeForm" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            @include('userRole/userRoleForm')

        </form>


    </div>


@endsection