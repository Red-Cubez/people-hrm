@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
                <input type="hidden" name="employeeId" id="employeeId" value="{{$employeeId}}">
                 <form name="employeeTimeoffForm" name="employeeTimeoffForm" class="table table-striped task-table"
                          action="{{ url('employeetimeoff') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        @include('employeeTimeoff.create')
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('employeeTimeoff.showEmployeeTimeoffs')
                </div>
            </div>
        </div>
    </main>
@endsection

