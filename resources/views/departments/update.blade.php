  @extends('layouts.app')
  @section('content')
  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
  <!-- New Department Form -->
    <form action="{{ url('departments/'.$department->id)}}"
          class="form-horizontal"
          method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <!-- Department Name -->
      @include('departments/departmentForm')
    </form>
  </div>
  @endsection