@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class=" display-flex">
            <div class="companyProject-item-1">
                @include('viewProject/viewProject')
                @permission(StandardPermissions::createEditCompanyProject)
                <span class="group ">
                <a href="/companyprojects/{{$project->projectId}}/edit">
                    <i class="fa fa-pencil-square-o fa-2x"></i>
                </a>
                </span>
                @endpermission
            </div>
            <div class="companyProject-item-2">
                @include('showGraph/showProjectGraph')
            </div>
        </div>
    </div>
        @permission(StandardPermissions::createEditCompanyProjectResource)
        <section>
            <div class="container">
                <div class="row row-content100">
            <div class="col-sm-12 text-center">
                <a href="{{route('companyprojectresources.show', $project->projectId)}}">
                    <button class="button button40 "> Add Resource</button>
                </a>
            </div>
        </div>
                <div class="row row-content">
                    <div class="col-xs-12">
                    @include('CompanyProjectResources/viewCompanyProjectResources')
                    </div>
                </div>
        @endpermission
            </div>
        </section>
@endsection