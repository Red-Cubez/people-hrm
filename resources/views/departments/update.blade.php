@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form action="{{ url('departments/'.$department->id)}}"
              class="form-horizontal"
              method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('departments/departmentForm')
        </form>
    </div>
@endsection