@extends('layouts.app')
@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Job Title Form -->


        <form action="{{url('jobtitle') }}"

              method="POST"
              class="form-horizontal">
            <input type="hidden" name="companyId" id="companyId" value="{{$companyId}}" >
            {{ csrf_field() }}
            @include('jobTitles/addJobTitleForm')
        </form>
    </div>

@endsection