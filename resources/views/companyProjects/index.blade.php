@extends('layouts.app')
@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New company Project Form -->
        <form action="{{url('companyprojects') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
              <div class="form-group" >
               <input type="hidden" name="companyid" value="{{$companyid}}">
               </div>
            <!-- Project Name -->
            @include('companyProjects/companyProjectForm')
         </form>

        
    </div>

    
@endsection