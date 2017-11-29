@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        @if(($timesheet->isApproved==0) && (!isset($showReadOnly)))
        <div class="row">
                <div class="col-sm-12">
                    <form action="{{ url('employeetimesheet/'.$timesheet->id) }}" class="table table-striped task-table"  method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        @include('employeeTimesheet.editForm')
                    </form>
                </div>
            
        </div>
        @elseif($timesheet->isApproved==1 || isset($showReadOnly)) 
        <div class="row">
            <div class="col-sm-12">
                @include('employeeTimesheet.showTimesheet')
            </div>
        </div>
        @endif
    </div>
</main>
@endsection
