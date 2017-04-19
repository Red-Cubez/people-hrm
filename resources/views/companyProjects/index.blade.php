@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New clientProject Form -->
        <form action="{{url('companyprojects') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Project Name -->

            @include('project/projectForm')



         </form>


         @include('project/showProjects')

    </div>
@endsection