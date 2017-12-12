@extends('layouts.app')
@section('content')
   
    <div class="container-fluid">
    @permission(StandardPermissions::viewCompany)
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
          
            <div class="col-sm-9 col-md-9">
              @permission(StandardPermissions::showCompanyProjects)
                @include('companyProjects/showProjects')
                @endpermission
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-3 col-md-3  nopadding">
                @permission([
                   StandardPermissions::reportOptions,
                   StandardPermissions::showAllProjectsReport,
                   StandardPermissions::showClientProjectsReport,
                   StandardPermissions::showInternalProjectsReport,
                   ])
                @include('companies/companyReports')
                @endpermission
            </div>
            <div class="col-sm-9 col-md-9">
                @permission(StandardPermissions::showClientProjects)
                @include('companyProjects/showClientProjectsOfCompany')
                @endpermission
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-3 col-md-3 nopadding ">
                @include('companyDepartments/showDepartments')
            </div>
            <div class="col-sm-9 col-md-9 ">
                  @include('companies/showCompanyCurrentEmployees')
            </div>
        </div>
        <div class="row ">
          @permission([
              StandardPermissions::createEditEmployee,
              StandardPermissions::viewOthersProfile,
              StandardPermissions::viewOwnProfile,
              StandardPermissions::showEmployees
             ])
         <div class="col-sm-3 col-md-3 nopadding ">
                   @include('employees/showEmployeesWithBirthdayThisMonth')
         </div>
             @endpermission
              <div class="col-sm-9 col-md-9 ">
                  @include('companies/showCompanyCurrentClients')
              </div>
               
        </div>
        @endpermission
    </div>
   
@endsection
