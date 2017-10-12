  @extends('layouts.app')
  @section('content')
  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <form id="employeeForm" name="employeeForm" class="form-horizontal">
      {{ csrf_field() }}

      <input type="hidden" name="action" id="action" value="update">
      <input type="hidden" name="employeeId" id="employeeId" value="{{$editEmployeeModel->employeeProfile->employeeId}}">

      @include('employees/employeeForm')
    </form>

  </div>
  @endsection