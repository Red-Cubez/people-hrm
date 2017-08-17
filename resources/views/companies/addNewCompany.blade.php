@extends('layouts.app')
@section('content')
<div class="panel-body">
    <!-- Display Validation Errors -->
@include('common.errors')
<!-- New Company Form -->
    <form action="{{url('companies') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        @include('companies/companyForm')

    </form>
</div>
@endsection