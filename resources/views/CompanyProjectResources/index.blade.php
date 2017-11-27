@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Company Project Resource</h1>
                </div>
            </div>
        </div>
    </article>
    <section class="company-project-resource-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row row-content">
                        <div class="col-xs-12 col-md-9 col-md-offset-3">

            <form id="resourceForm" name="resourceForm" class="form-horizontal">
                {{ csrf_field() }}
                @if(isset($companyProjectId))
                    <input type="hidden" name="companyProjectId" value="{{ $companyProjectId }}">
                @endif
                @if(isset($projectresources))
                    @if(isset($companyProjectId))
                        <input type="hidden" name="companyProjectId"
                               value="{{ $projectresources[0]->company_project_id}}" class="form-control">
                    @endif
                @endif
                <div><input type="radio" name="resource" id="resource" value="employee" required> <label
                            for="choice-animals-dogs">Employee Resource</label>
                    <div class="reveal-if-active">
                        @include('projectResources/employeeResourcesForm')
                    </div>
                </div>
                <div>
                    <input type="radio" name="resource" id="resource" value="fixed" required> <label
                            for="choice-animals-cats">Fixed
                        Resources</label>
                    <div class="reveal-if-active"></div>
                    @include('projectResources/fixedResourcesForm')
                </div>
            </form>
                            <div class="row row-content">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-md-pull-2 ">
                                    <div class="form-group">
                            @include('CompanyProjectResources/viewCompanyProjectResources')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

