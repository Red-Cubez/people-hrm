
@extends('layouts.app')

@section('content')

    <main>
        <div class="container">
            <div class="row">
                <input type="hidden" name="employeeId" id="employeeId" value="{{$employeeId}}">
                <div class="col-sm-12">
                    <form class="table table-striped task-table" action="{{ url('employeetimesheet') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        @include('timesheet::employeeTimesheet.create')
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                @include('timesheet::employeeTimesheet.showEmployeeTimesheets')
                </div>
            </div>
        </div>
    </main>

@endsection

