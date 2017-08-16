
@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        @if($timesheet->isApproved==0)
        <div class="row">
                <div class="col-sm-12">
                    <form action="{{ url('employeetimesheet/'.$timesheet->id) }}" class="table table-striped task-table"  method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        @include('timesheet::employeeTimesheet.editForm')
                    </form>
                </div>
            </input>
        </div>
        @elseif($timesheet->isApproved==1)
        <div class="row">
            <div class="col-sm-12">
                @include('timesheet::employeeTimesheet.showTimesheet')
            </div>
        </div>
        @endif
    </div>
</main>
@endsection
