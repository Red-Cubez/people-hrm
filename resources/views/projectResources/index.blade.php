@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <form name="resourceForm" id="resourceForm" class="form-horizontal">
            {{ csrf_field() }}
            @if(isset($clientProjectid))
                <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">
            @endif
            @if(!isset($projectresources))
                @if(isset($clientProjectid))
                    <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}" class="form-control">
                @endif
            @elseif(isset($projectresources))
                @if(isset($clientProjectid))
                    <input type="hidden" name="clientProjectid"
                           value="{{ $projectresources[0]->client_project_id}}" class="form-control">
                @endif
            @endif
            <div>
                <input type="radio" name="resource" value="employee" id="resource"> <label
                        for="choice-animals-dogs">Employee Resource</label>
                <div id="error"></div>
                <div class="reveal-if-active">
                    @include('projectResources/employeeResourcesForm')
                </div>
                <div><input type="radio" name="resource" value="fixed" id="resource" required>
                    <label for="choice-animals-cats">Fixed Resources</label>
                    @include('projectResources/fixedResourcesForm')
                </div>
            </div>
        </form>
    </div>
    @include('projectResources/showCurrentResources')
@endsection
