@extends('layouts.app')
@section('content')
<section class="editCompanyProjectsection">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
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
    </div>
    </div>
    </section>

   
@endsection







