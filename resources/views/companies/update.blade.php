  @extends('layouts.app')
  @section('content')
  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
  <!-- Update Company Form -->
    <form action="{{ url('companies/'.$company->id)}}"
          class="form-horizontal"
          method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <!-- Company Names -->
      @include('companies/companyForm')

    </form>
  </div>
  @endsection