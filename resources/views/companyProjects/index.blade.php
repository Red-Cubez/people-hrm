@extends('layouts.app')
@section('content')
<div>
    <div class="panel-body col-sm-12" >
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New company Project Form -->
        <form id="projectForm" name="projectForm" class="form-horizontal">
            {{ csrf_field() }}

               <input type="hidden"  name="companyid" value="{{$companyid}}">
               <input type="hidden" name="action" id="action" value="save">

            <!-- Project Name -->
            @include('companyProjects/companyProjectForm')
         </form>

    </div>

</div>
@endsection