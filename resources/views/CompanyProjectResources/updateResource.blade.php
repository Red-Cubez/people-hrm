  @extends('layouts.app')
  @section('content')

  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
 <!-- Update Company Form -->
    <form action="{{ url('companyprojectresources/')}}" class="form-horizontal" method="POST">

      {{ csrf_field() }}
      {{ method_field('POST') }}
      <!-- Company Names -->
    
      @include('projectResources/fixedResourcesForm')

    </form>
     </div>
     @endsection
  