@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New client Form -->
        <form action="{{url('clients') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="companyId" value="{{$companyId}}">
        <!-- client Name -->
            @include('clients/clientForm')
        </form>
    </div>


@endsection