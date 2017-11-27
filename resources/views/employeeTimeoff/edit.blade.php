@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            @if($timeoff->is_pproved==0)
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="timeoffId" id="timeoffId" value="{{$timeoff->id}}">
                        <form name="employeeTimeoffForm" id="employeeTimeoffForm"
                              action="{{ url('employeetimeoff/'.$timeoff->id) }}" class="table table-striped task-table"
                              method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            @include('employeeTimeoff.create')
                        </form>
                    </div>
                    </input>
                </div>
            @endif
        </div>
    </main>
@endsection
