
  @extends('layouts.app')
  @section('content')
  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
  <!-- New Employee Form -->
  <form action="{{url('companyprojects/'.$companyproject->id)}}" method="POST" class="form-horizontal">
       {{ csrf_field() }}
       {{ method_field('PUT') }}
      <!-- Employee Name -->
      @include('project/projectForm')
</form>
  </div>
  @endsection





