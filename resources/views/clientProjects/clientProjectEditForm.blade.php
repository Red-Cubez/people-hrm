    @extends('layouts.app')

    @section('content')

    <div class="panel-body">
      <!-- Display Validation Errors -->
      @include('common.errors')
      <form action="{{ url('clientprojects/'.$clientProject->id)}}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <!-- Client Project Name -->
        @include('clientProjects/clientProjectForm')
      </form>
    </div>
    @endsection