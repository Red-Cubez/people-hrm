@extends('layouts.app')

@section('content')

    <div class="panel-body">

        <div>
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

                <div ><input type="radio" name="resource" id="resource" value="employee" required> <label
                            for="choice-animals-dogs" >Employee Resource</label>
                    <div class="reveal-if-active">

                        @include('projectResources/employeeResourcesForm')

                    </div>
                </div>
                    <div><input type="radio" name="resource" id="resource" value="fixed" required> <label
                                for="choice-animals-cats">Fixed
                            Resources</label>
                        <div class="reveal-if-active"></div>

                        @include('projectResources/fixedResourcesForm')

                    </div>

            </form>
        </div>

    </div>




    @include('CompanyProjectResources/viewCompanyProjectResources')



@endsection

