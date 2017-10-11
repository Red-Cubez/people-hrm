@extends('layouts.app')

@section('content')

@permission(StandardPermissions::getPermissionName(StandardPermissions::viewCompany))
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
        @permission(StandardPermissions::getPermissionName(StandardPermissions::showCompanyProjects))
        <div class="col-sm-8">
            @include('companyProjects/showProjects')
        </div>
        @endpermission
  
    </div>

    <div class="row">
        
        @permission(StandardPermissions::getPermissionName(StandardPermissions::showClientProjects))
        <div class="col-sm-8">
            @include('companyProjects/showClientProjectsOfCompany')
        </div>
        @endpermission
        
        @permission([
            StandardPermissions::getPermissionName(StandardPermissions::reportOptions),
            StandardPermissions::getPermissionName(StandardPermissions::showAllProjectsReport),
            StandardPermissions::getPermissionName(StandardPermissions::showClientProjectsReport),
            StandardPermissions::getPermissionName(StandardPermissions::showInternalProjectsReport),
            ])
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
        
       @permission([
        StandardPermissions::getPermissionName(StandardPermissions::createEditEmployee),
        StandardPermissions::getPermissionName(StandardPermissions::viewOthersProfile),
        StandardPermissions::getPermissionName(StandardPermissions::viewOwnProfile),
        StandardPermissions::getPermissionName(StandardPermissions::showEmployees)
       ])
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
