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
            <input type="hidden" name="companyId" value="{{$companyId}}">
            @include('employees/employeeForm')



        </form>

    </div>


@endsection