@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('companies/showCompanyProfile')
        </div>
        <div class="col-sm-7">
            @include('companyHolidays/showHolidays')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            @include('companies/showCompanyJobTitles')
        </div>
        <div class="col-sm-8">
            @include('companyProjects/showProjects')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            @include('companyProjects/showClientProjectsOfCompany')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @include('employees/showEmployeesWithBirthdayThisMonth')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            @include('companies/showCompanyCurrentEmployees')
        </div>
        <div class="col-sm-5">
            @include('companies/showCompanyCurrentClients')
        </div>
    </div>
</div>
@endsection
