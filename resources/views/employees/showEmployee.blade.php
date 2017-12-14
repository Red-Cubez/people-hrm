@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Employee </h1>
                </div>
            </div>
        </div>
    </article>
    <section class="mainShowEmployeeSection">
        <div class="container-fluid">
            <div class="row">
                @include('common.errors')
                    <div class="col-xs-12">
                        <div class="panel-body">
                          <div class="col-md-6 col-md-offset-3">
                              <ul class="list-group">
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          First Name :
                                      </label>
                                      {{$employeeModel->employeeProfile->firstName}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Last Name :
                                      </label>
                                      {{$employeeModel->employeeProfile->lastName}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Hire Date :
                                      </label>
                                      {{$employeeModel->employeeProfile->hireDate}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Job Title :
                                      </label>
                                      {{$employeeModel->employeeProfile->jobTitle}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Annual Salary :
                                      </label>
                                      {{$employeeModel->employeeProfile->annualSalary}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Hourly Rate :
                                      </label>
                                      {{$employeeModel->employeeProfile->hourlyRate}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Overtime Rate :
                                      </label>
                                      {{$employeeModel->employeeProfile->overTimeRate}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          streetLine1 :
                                      </label>
                                      {{$employeeModel->employeeProfile->streetLine1}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          streetLine2 :
                                      </label>
                                      {{$employeeModel->employeeProfile->streetLine2}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          country :
                                      </label>
                                      {{$employeeModel->employeeProfile->country}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          state / Province :
                                      </label>
                                      {{$employeeModel->employeeProfile->stateProvince}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          city :
                                      </label>
                                      {{$employeeModel->employeeProfile->city}}
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Departments :
                                      </label>
                                      @foreach ($employeeModel->employeeDepartmentIds as $departmentName)
                                          {{$departmentName}}
                                          {{ "|" }}
                                      @endforeach
                                  </li>
                                  <li class="list-group-item">
                                      <label class="control-label" for="name">
                                          Hours Worked :
                                      </label>
                                      {{$employeeModel->totalHoursWorked()}}
                                  </li>
                                  <li class="list-group-item">
                                      Employee is
                                      @if(!isset($employeeModel->isWorkingOverTime))
                                          Not
                                      @endif
                                      Working Over Time.
                                  </li>
                                  <li class="list-group-item">
                                    <div class="aParent ">
                                      @permission(StandardPermissions::createEditEmployee)
                                      <a href="/employees/{{$employeeModel->employeeProfile->employeeId}}/edit" >
                                          <button class="button20">
                                              <i class="fa fa-pencil-square-o fa-2x"></i>
                                          </button>
                                      </a>
                                      @endpermission
                                    
                                      @permission(StandardPermissions::deleteEmployee)
                                      @if(Auth::user()->employee->id!=$employeeModel->employeeProfile->employeeId)
                                      <form action="{{ url('employees/'.$employeeModel->employeeProfile->employeeId) }}"
                                            method="POST">
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}
                                          <div class="group">
                                          <button class="button20"  data-toggle="confirmation" data-singleton="true" type="submit">
                                              <i class="fa fa-trash fa-2x"></i>
                                          </button>
                                          </div>
                                      </form>
                                      @endif
                                      @endpermission
                                       </div>
                                  </li>
                              </ul>
                          </div>

                        </div>
                    </div>
            </div>
            <div class="row row-content">
               
                    <div class="row row-content100 padTop5">
                        <div class="col-sm-12 col-md-11 col-md-offset-1">
                         @permission(StandardPermissions::createEditTimesheet)
                            <a href="/employeetimesheet/{{$employeeModel->employeeProfile->employeeId}}/create">
                                <button class="button button50"> Add Timesheet</button>
                            </a>
                            @endpermission
            @permission(StandardPermissions::approveTimesheets)
            <a href="/employeestimesheets/">
                <button class="button button50"> Approve Timesheets</button>
            </a>
            @endrole
            @permission(StandardPermissions::createEditTimeoff)
            <a href="/employeetimeoff/{{$employeeModel->employeeProfile->employeeId}}/create">
                <button class="button button50"> Add Time Off</button>
            </a>
            @endpermission
            @permission(StandardPermissions::approveTimeoffs)
            <a href="/employeestimeoffs/">
                <button class="button button50"> Approve Time Offs</button>
            </a>
            @endpermission
                        </div>
                    </div>
            <div class="row ">
                <div class="col-sm-5">
                    @include('employees/showCompanyHolidays')
                </div>
                <div class="col-sm-7">
                    @include('employees/showEmployeeClientProjects')
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    @include('employees/showEmployeesWithBirthdayThisMonth')
                </div>
                <div class="col-sm-7">
                    @include('employees/showEmployeeCompanyProjects')
                </div>
            </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>
@endsection