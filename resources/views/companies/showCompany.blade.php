@extends('layouts.app')

@section('content')

@permission(StandardPermissions::viewCompany)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 nopadding">
            @include('companies/showCompanyProfile')
        </div>
        <div class="col-sm-9">
            @include('companyHolidays/showHolidays')
        </div>
    </div>

    <div class="row">

        <div class="col-sm-3 col-md-3 nopadding">
            @include('companies/showCompanyJobTitles')
        </div>
        @permission(StandardPermissions::showCompanyProjects)
        <div class="col-sm-9 col-md-9">
            @include('companyProjects/showProjects')
        </div>
        @endpermission
  
    </div>

    <div class="row">
        @permission([
           StandardPermissions::reportOptions,
           StandardPermissions::showAllProjectsReport,
           StandardPermissions::showClientProjectsReport,
           StandardPermissions::showInternalProjectsReport,
           ])
        <div class="col-sm-3 nopadding">
            @include('companies/companyReports')
        </div>
        @endpermission
        @permission(StandardPermissions::showClientProjects)
        <div class="col-sm-9">
            @include('companyProjects/showClientProjectsOfCompany')
        </div>
        @endpermission
    </div>
    <div class="row">
        <div class="col-sm-3 nopadding">
            @include('companyDepartments/showDepartments')
        </div>
        <div class="col-sm-9">
            @include('employees/showEmployeesWithBirthdayThisMonth')
        </div>

    </div>
    <div class="row">
        
       @permission([
        StandardPermissions::createEditEmployee,
        StandardPermissions::viewOthersProfile,
        StandardPermissions::viewOwnProfile,
        StandardPermissions::showEmployees
       ])
        <div class="col-sm-6 nopadding">
            @include('companies/showCompanyCurrentEmployees')
        </div>
       @endpermission 
        <div class="col-sm-6">
            @include('companies/showCompanyCurrentClients')
        </div>
    </div>
</div>
@endpermission
@endsection
