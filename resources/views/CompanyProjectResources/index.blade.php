@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#employees" aria-expanded="false"
           aria-controls="collapseExample"> Employees
        </a>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#fixedResources"
                aria-expanded="false" aria-controls="collapseExample"> Fixed Resources
        </button>

        <div class="collapse" id="employees">
            <div class="well">
                @include('projectResources/employeeResourcesForm')
            </div>
            \
        </div>

        <div class="collapse" id="fixedResources">
            <div class="well">
                @include('projectResources/fixedResourcesForm')
            </div>
        </div>
    </div>

    @include('CompanyProjectResources/viewCompanyProjectResources')

@endsection