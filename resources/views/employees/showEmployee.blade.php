@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="panel-body">
                    @include('common.errors')
                    <div class="">
                        <div class="col-sm-3">
                            <div>
                                <label class="control-label" for="name">
                                    First Name :
                                </label>
                                {{$employeeModel->employeeProfile->firstName}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Last Name :
                                </label>
                                {{$employeeModel->employeeProfile->lastName}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Hire Date :
                                </label>
                                {{$employeeModel->employeeProfile->hireDate}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Job Title :
                                </label>
                                {{$employeeModel->employeeProfile->jobTitle}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Annual Salary :
                                </label>
                                {{$employeeModel->employeeProfile->annualSalary}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Hourly Rate :
                                </label>
                                {{$employeeModel->employeeProfile->hourlyRate}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Overtime Rate :
                                </label>
                                {{$employeeModel->employeeProfile->overTimeRate}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    streetLine1 :
                                </label>
                                {{$employeeModel->employeeProfile->streetLine1}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    streetLine2 :
                                </label>
                                {{$employeeModel->employeeProfile->streetLine2}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    country :
                                </label>
                                {{$employeeModel->employeeProfile->country}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    state / Province :
                                </label>
                                {{$employeeModel->employeeProfile->stateProvince}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    city :
                                </label>
                                {{$employeeModel->employeeProfile->city}}
                            </div>
                            <div>
                                <label class="control-label" for="name">
                                    Departments :
                                </label>
                                @foreach ($employeeModel->employeeDepartmentIds as $departmentName)
                                    {{$departmentName}}
                                    {{ "|" }}
                                @endforeach
                            </div>
                            <label class="control-label" for="name">
                                Hours Worked :
                            </label>
                            {{$employeeModel->totalHoursWorked()}}
                            <div>
                                Employee is
                                @if(!isset($employeeModel->isWorkingOverTime))
                                    Not
                                @endif
                                Working Over Time.
                            </div>
                            <br>
                            <a href="/employees/{{$employeeModel->employeeProfile->employeeId}}/edit">
                                <button class="btn btn-primary"> Edit

                                </button>
                            </a>
                            {{--<form action="{{ url('employees/'.$employeeModel->employeeProfile->employeeId.'/edit') }}" method="POST">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--{{ method_field('GET') }}--}}
                            {{--<button class="btn btn-primary" type="submit">--}}
                            {{--<i class="fa fa-trash">--}}
                            {{--EDIT--}}
                            {{--</i>--}}
                            {{--</button>--}}
                            {{--</form>--}}
                            <form action="{{ url('employees/'.$employeeModel->employeeProfile->employeeId) }}"
                                  method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit">
                                    <i c="" lass="fa fa-trash">
                                        DELETE
                                    </i>
                                </button>
                            </form>

                        </div>
                        <div class="col-sm-5">

                            @include('employees/showCompanyHolidays')

                        </div>
                        <div class="col-sm-4">

                            @include('employees/showEmployeesWithBirthdayThisMonth')

                        </div>
                    </div>
                    <div class="">
                        <div class="col-sm-12">
                            <form class="panel-body" action="{{ url('employeetimeline/') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}

                                @include('employees/employeeTimeSheet')
                            </form>
                        </div>
                    </div>
                    @include('employees/showEmployeeClientProjects')
                    @include('employees/showEmployeeCompanyProjects')

                </div>
                @endsection
            </div>
        </div>
    </main>