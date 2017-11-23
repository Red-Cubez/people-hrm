@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form action="{{url('jobtitle') }}" method="POST" class="form-horizontal">
            <input type="hidden" name="companyId" id="companyId" value="{{$companyId}}"> {{ csrf_field() }}
            @include('jobTitles/addJobTitleForm')
        </form>
    </div>
@endsection