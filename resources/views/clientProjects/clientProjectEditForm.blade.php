    @extends('layouts.app')

    @section('content')

    <div class="panel-body">
      <!-- Display Validation Errors -->
      @include('common.errors')
      <form id="projectForm" name="projectForm" class="form-horizontal" method="POST">
        {{ csrf_field() }}

          <input type="hidden" name="action" id="action" value="update">
          <input type="hidden" name="clientProjectId" id="clientProjectId" value="{{$clientProject->id}}">
       
        @include('clientProjects/clientProjectForm')
      </form>
    </div>
   
    @endsection