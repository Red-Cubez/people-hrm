@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form action="{{url('company-settings') }}" name="employeeForm" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            @include('companySettings/companySettingsForm')
            <input type="hidden" name="companyId" value="{{$companyId}}"/>
        </form>
    </div>
@endsection