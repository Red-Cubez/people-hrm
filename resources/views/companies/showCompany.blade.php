@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                @include('companies/showCompanyProfile')
                <form action="{{ url('companies/'.$companyProfileModel->companyId.'/edit') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}

                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"> Edit Company</i>
                    </button>
                </form>

            </div>{{--end div of included page--}}

        </div>
        <div class="col-sm-7">
            @include('companyHolidays/showHolidays')
            <form action="{{ url('companyholidays/') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}
                <input type="hidden" name="companyId" value="{{$companyProfileModel->companyId}}">

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"> Set Holidays</i>
                </button>
            </form>

        </div>{{--end div of included page--}}
        </div>

    </div>

    <div class="row">
        <div class="col-sm-3">
            @include('companies/showCompanyJobTitles')
            <form action="{{ url('jobtitle/'.$companyProfileModel->companyId) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"> Add New Job Title</i>
                </button>

            </form>

        </div> {{--end div of included page--}}
        </div>

        <div class="col-sm-8">
            @include('companyProjects/showProjects')
            <form action="{{ url('/companies/'.$companyProfileModel->companyId.'/companyprojects') }}"
                  method="POST">
                {{ csrf_field() }}
                {{ method_field('GET') }}
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"> Add New Projects</i>
                </button>
            </form>
        </div>{{--end div of included page--}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">

            @include('employees/showEmployeesWithBirthdayThisMonth')


        </div>
    </div>

    </div>

@endsection