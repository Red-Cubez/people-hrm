@extends('layouts.app')
@section('content')
<div>
    <div class="panel-body col-sm-4" >
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

</div>
@endsection