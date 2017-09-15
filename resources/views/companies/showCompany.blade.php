@extends('layouts.app')

@section('content')
@role(['manager','admin','hr-manager','client-manager'])
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
        <div class="col-sm-8">
            @include('companyProjects/showClientProjectsOfCompany')
        </div>
        <div class="col-sm-3">
            @include('companies/companyReports')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('employees/showEmployeesWithBirthdayThisMonth')
        </div>
        <div class="col-sm-5">
            @include('companyDepartments/showDepartments')
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
@endrole
@endsection
