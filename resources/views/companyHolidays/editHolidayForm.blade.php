
@extends('layouts.app')
@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <form action="{{url('companyholidays/'.$holiday->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="companyId" value="{{$holiday->company_id}}">
            <div class="form-group" >

            </div>

            @include('companyHolidays/addHolidayForm')
        </form>



    </div>
@endsection


















