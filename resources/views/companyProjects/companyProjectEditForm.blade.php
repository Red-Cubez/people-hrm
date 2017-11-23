@extends('layouts.app')
@section('content')
    <section class="editCompanyProjectsection">
        <div class="container">
            <div class="row row-content">
                <div class="col-xs-12 col-md-9 col-md-offset-3">
                    @include('common.errors')
                    <form id="projectForm" name="projectForm" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" id="action" value="update">
                        <input type="hidden" name="companyProjectId" id="companyProjectId"
                               value="{{$companyproject->id}}">
                        @include('companyProjects/companyProjectForm')
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection







