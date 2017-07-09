@extends('layouts.app')

@section('content')

  <div class="panel-body">
    <!-- Display Validation Errors -->
  @include('common.errors')
  <!-- New Employee Form -->
    <form id="projectForm" name="projectForm" class="form-horizontal">
      {{ csrf_field() }}
      <input type="hidden" name="action" id="action" value="update">
      <input type="hidden" name="companyProjectId" id="companyProjectId" value="{{$companyproject->id}}">
      <!-- Company Project Name -->
      @include('companyProjects/companyProjectForm')
    </form>

  </div>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--<div class="panel-body">--}}
{{--<!-- Display Validation Errors -->--}}
{{--@include('common.errors')--}}
{{--<!-- New Employee Form -->--}}
{{--<form action="{{url('companyprojects/'.$companyproject->id)}}" method="POST" class="form-horizontal">--}}
{{--{{ csrf_field() }}--}}
{{--{{ method_field('PUT') }}--}}
{{--<!-- Company Project Name -->--}}
{{--@include('companyProjects/companyProjectForm')--}}
{{--</form>--}}
{{--</div>--}}
{{--@endsection--}}





