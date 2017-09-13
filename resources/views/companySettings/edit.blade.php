@extends('layouts.app')
@section('content')
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
  
    <form action="{{url('company-settings/'.$companySetting->id) }}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
            {{method_field('PUT')}}
            @include('companySettings/companySettingsForm')
    </form>
</div>
@endsection
