@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-6">
                <div class="panel-body">
                    @include('common.errors')
                    <div>

                        <label for="name" class="control-label">Name : </label>


                        {{$companyProfileModel->companyName}}

                    </div>
                    <div>

                        <label for="normalHoursPerWeek" class="control-label">Normal Hours / Week : </label>


                        {{$companyProfileModel->normalHoursPerWeek}}

                    </div>
                    <div>

                        <label for="applyOverTimeRule" class="control-label">Over Time Rule : </label>


                        @if(($companyProfileModel->applyOverTimeRule)==1)
                            Yes
                        @elseif(($companyProfileModel->applyOverTimeRule==0))
                            No
                        @endif

                    </div>
                    <div>
                        <label for="contactPerson" class="control-label">Street Line 1 : </label>

                        {{$companyProfileModel->streetLine1 }}

                    </div>
                    <div>
                        <label for="contactPerson" class="control-label">Street Line 2 : </label>

                        {{$companyProfileModel->streetLine2 }}

                    </div>
                    <div>
                        <label for="contactPerson" class="control-label">Country: </label>

                        {{$companyProfileModel->country }}

                    </div>
                    <div>
                        <label for="contactPerson" class="control-label">State / Province : </label>

                        {{$companyProfileModel->stateProvince }}

                    </div>

                    <div>
                        <label for="contactPerson" class="control-label">City</label>

                        {{$companyProfileModel->city }}

                    </div>


                    <form action="{{ url('companies/'.$companyProfileModel->companyId.'/edit') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}

                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"> Edit Company</i>
                        </button>
                    </form>

                </div>
            </div>
            <div class="col-sm-6">
                @include('companyHolidays/showHolidays')
            </div>
            <form action="{{ url('companyholidays/') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}
                <input type="hidden" name="companyId" value="{{$companyProfileModel->companyId}}">

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"> Set Holidays</i>
                </button>
            </form>
        </div>

        <div class="col-sm-6 pull-right">
            <label for="jobTtitles" class="control-label">Company Job Titles: </label>

            @foreach($companyProfileModel->jobTitles as $companyJobTitle)
                {{$companyJobTitle}}
                {{  " | " }}
            @endforeach

            <form action="{{ url('jobtitle/'.$companyProfileModel->companyId) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"> Add New Job Title</i>
                </button>
            </form>
        </div>


        <div class="row">
            <div class="col-sm-6">
                @include('companyProjects/showProjects')

                <form action="{{ url('/companies/'.$companyProfileModel->companyId.'/companyprojects') }}"
                      method="POST">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}


                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"> Add New Projects</i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

                @include('companies/showEmployeesWithBirthdayThisMonth')


            </div>
        </div>
    </div>



@endsection