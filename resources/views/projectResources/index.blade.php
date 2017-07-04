@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @if (isset($formErrors))
            <div class="alert alert-danger">
                <ul>

                    @if(isset($formErrors->employeeNotSelected))
                        <li>{{ $formErrors->employeeNotSelected}}</li>
                    @endif
                    @if(isset($formErrors->startDateNotEntered))
                        <li>{{ $formErrors->startDateNotEntered}}</li>
                    @endif
                    @if(isset($formErrors->endDateNotEntered))
                        <li>{{$formErrors->endDateNotEntered}}</li>
                    @endif
                    @if(isset($formErrors->wrongEndDate))
                        <li>{{$formErrors->wrongEndDate}}</li>
                    @endif

                </ul>
            </div>
        @endif
        <form id="resourceForm" action="{{ url('projectresources/') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            @if(isset($clientProjectid))
                <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">
            @endif
            @if(isset($clientProjectid))
                <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">
            @endif
            @if(!isset($projectresources))
                @if(isset($clientProjectid))
                    <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}"
                           class="form-control">
                @endif

            @elseif(isset($projectresources))
                @if(isset($clientProjectid))

                    <input type="hidden" name="clientProjectid"
                           value="{{ $projectresources[0]->client_project_id}}" class="form-control">
                @endif
            @endif

            <div><input type="radio" name="resource" value="employee" id="resource"> <label
                        for="choice-animals-dogs">Employee Resource</label>
                <div id="error"></div>
                <div class="reveal-if-active">


                    @include('projectResources/employeeResourcesForm')

                </div>
                <div><input type="radio" name="resource" value="fixed" id="resource"  required > <label
                            for="choice-animals-cats">Fixed
                        Resources</label>
                    @include('projectResources/fixedResourcesForm')

                </div>
            </div>
        </form>
    </div>



    {{--<div class="panel-body">--}}
    {{--<a class="btn btn-primary" role="button" data-toggle="collapse" href="#employees" aria-expanded="false"--}}
    {{--aria-controls="collapseExample"> Employees--}}
    {{--</a>--}}
    {{--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#fixedResources"--}}
    {{--aria-expanded="false" aria-controls="collapseExample"> Fixed Resources--}}
    {{--</button>--}}
    {{--<div class="collapse" id="employees">--}}
    {{--<div class="well">--}}
    {{--<form action="{{ url('projectresources/') }}" method="POST" class="form-horizontal">--}}
    {{--{{ csrf_field() }}--}}
    {{--{{ method_field('POST') }}--}}
    {{--@if(isset($clientProjectid))--}}
    {{--<input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">--}}
    {{--@endif--}}
    {{--@include('projectResources/employeeResourcesForm')--}}
    {{--@include('projectResources/fixedResourcesForm')--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<form action="{{ url('projectresources/') }}" method="POST" class="form-horizontal">--}}
    {{--{{ csrf_field() }}--}}
    {{--{{ method_field('POST') }}--}}
    {{--@if(isset($clientProjectid))--}}
    {{--<input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">--}}
    {{--@endif--}}
    {{--@if(!isset($projectresources))--}}
    {{--@if(isset($clientProjectid))--}}
    {{--<input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}"--}}
    {{--class="form-control">--}}
    {{--@endif--}}

    {{--@elseif(isset($projectresources))--}}
    {{--@if(isset($clientProjectid))--}}

    {{--<input type="hidden" name="clientProjectid"--}}
    {{--value="{{ $projectresources[0]->client_project_id}}" class="form-control">--}}
    {{--@endif--}}
    {{--@endif--}}
    {{--<div class="collapse" id="fixedResources">--}}
    {{--<div class="well">--}}
    {{--@include('projectResources/fixedResourcesForm')--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}

    @include('projectResources/showCurrentResources')
@endsection