@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- Edit job titles -->

        <form action="{{ url('jobtitle/'.$jobTitle->id)}}"
              class="form-horizontal"
              method="POST">
            <input type="hidden" name="companyId" id="companyId" value="{{$jobTitle->company_id}}">

            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <!-Name -->
            @include('jobTitles/addJobTitleForm')
        </form>
    </div>
@endsection