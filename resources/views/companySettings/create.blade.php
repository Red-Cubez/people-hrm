@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Employee Form -->
        <!-- New Employee Form -->
        <form id="employeeForm" action="{{url('company-settings') }}"  name="employeeForm" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            
            @include('companySettings/companySettingsForm')
        <input type="hidden" name="companyId" value="{{$companyId}}" />
        </form>


    </div>


@endsection