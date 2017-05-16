  @extends('layouts.app')
  @section('content')
  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Employee Form -->
    <form action="{{ url('employees/'.$editEmployeeModel->employeeProfile->employeeId)}}"
      class="form-horizontal"
      method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <!-- Employee Name -->
      @include('employees/employeeForm')
    </form>
  </div>
  @endsection