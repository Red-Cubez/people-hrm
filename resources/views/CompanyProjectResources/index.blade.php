@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <div>
            <form id="resourceForm" action="{{ url('companyprojectresources/') }}" method="POST"
                  class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                @if(isset($companyProjectId))
                    <input type="hidden" name="companyProjectId" value="{{ $companyProjectId }}">

                @endif
                @if(isset($companyProjectId))

                    <input type="hidden" name="companyProjectId" value="{{ $companyProjectId }}"
                           class="form-control">
                @endif

                @if(isset($projectresources))
                    @if(isset($companyProjectId))
                        <input type="hidden" name="companyProjectId"
                               value="{{ $projectresources[0]->company_project_id}}" class="form-control">
                    @endif
                @endif

                <div><input type="radio" name="resource" id="resource" value="employee"> <label
                            for="choice-animals-dogs">Employee Resource</label>
                    <div class="reveal-if-active">


                        @include('projectResources/employeeResourcesForm')

                    </div>
                    <div><input type="radio" name="resource" id="resource" value="fixed" required> <label
                                for="choice-animals-cats">Fixed
                            Resources</label>
                        <div class="reveal-if-active"></div>

                        @include('projectResources/fixedResourcesForm')

                    </div>
                </div>
            </form>
        </div>

    </div>


    {{--<div class="panel-body">--}}
        {{--<div class="panel-heading">Add Resource</div>--}}

        {{--<a class="btn btn-primary" role="button" data-toggle="collapse" href="#employees" aria-expanded="false"--}}
           {{--aria-controls="collapseExample"> Employees--}}
        {{--</a>--}}
        {{--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#fixedResources"--}}
                {{--aria-expanded="false" aria-controls="collapseExample"> Fixed Resources--}}
        {{--</button>--}}

        {{--<div class="collapse" id="employees">--}}
            {{--<div class="well">--}}
                {{--<form action="{{ url('companyprojectresources/') }}" method="POST" class="form-horizontal">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--{{ method_field('POST') }}--}}
                    {{--@if(isset($companyProjectId))--}}
                        {{--<input type="hidden" name="companyProjectId" value="{{ $companyProjectId }}">--}}

                    {{--@endif--}}
                    {{--@include('projectResources/employeeResourcesForm')--}}
                    {{--@include('projectResources/fixedResourcesForm')--}}
                {{--</form>--}}
            {{--</div>--}}

        {{--</div>--}}

        {{--<div class="collapse" id="fixedResources">--}}
            {{--<div class="well">--}}
                {{--<form action="{{ url('companyprojectresources/') }}" method="POST" class="form-horizontal">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--{{ method_field('POST') }}--}}
                    {{--@if(isset($companyProjectId))--}}

                        {{--<input type="hidden" name="companyProjectId" value="{{ $companyProjectId }}"--}}
                               {{--class="form-control">--}}
                    {{--@endif--}}

                    {{--@if(isset($projectresources))--}}
                        {{--@if(isset($companyProjectId))--}}
                            {{--<input type="hidden" name="companyProjectId"--}}
                                   {{--value="{{ $projectresources[0]->company_project_id}}" class="form-control">--}}
                        {{--@endif--}}
                    {{--@endif--}}
                    {{--@include('projectResources/fixedResourcesForm')--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    @include('CompanyProjectResources/viewCompanyProjectResources')

@endsection