@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form id="saveForm" action="{{url('companyholidays') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="form-group">
                <input type="hidden" name="companyId" value="{{$companyId}}">
            </div>
            @include('companyHolidays/addHolidayForm')
        </form>
    </div>
@endsection

