@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form id="resourceForm" action="{{url('companyprojectresources') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            @include('projectResources/fixedResourcesForm')
        </form>
    </div>
@endsection
  