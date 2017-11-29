@extends('layouts.app')
@section('content')
<section>
<div class="container">
            <div class="row">
                <input type="hidden" name="employeeId" id="employeeId" value="{{$employeeId}}" />
                <div class="col-sm-12">
                    <form  action="{{ url('employeetimesheet') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        @include('employeeTimesheet.createForm')
                    </form>
                </div>
            </div>
            <div class="row row-content">
                <div class="col-sm-12">
                @include('employeeTimesheet.showEmployeeTimesheets')
                </div>
            </div>
        </div>
</section>
@endsection