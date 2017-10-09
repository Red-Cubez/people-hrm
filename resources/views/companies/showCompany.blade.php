@extends('layouts.app')

@section('content')

@permission('view-company')
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
        @permission(['show-companyProjects'])
        <div class="col-sm-8">
            @include('companyProjects/showProjects')
        </div>
        @endpermission
  
    </div>

    <div class="row">
        @permission(['show-clientProjects'])
        <div class="col-sm-8">
            @include('companyProjects/showClientProjectsOfCompany')
        </div>
        @endpermission
        @permission(['reportOptions','showAllProjects','showClientProjects','showInternalProjects'])
        <div class="col-sm-3">
            @include('companies/companyReports')
        </div>
        @endpermission
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
       @permission(['create/edit-employee','view-employee','show-employees'])
        <div class="col-sm-5">
            @include('companies/showCompanyCurrentEmployees')
        </div>
       @endpermission 
        <div class="col-sm-5">
            @include('companies/showCompanyCurrentClients')
        </div>
    </div>
</div>
@endpermission
@endsection
