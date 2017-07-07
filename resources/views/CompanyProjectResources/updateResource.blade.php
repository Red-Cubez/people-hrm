  @extends('layouts.app')
  @section('content')

  <div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
 <!-- Update Company Form -->
    <form id="resourceForm" name="resourceForm" class="form-horizontal">

      {{ csrf_field() }}

      <!-- Company Names -->
    
      @include('projectResources/fixedResourcesForm')

    </form>
     </div>
     @endsection
  