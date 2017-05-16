@extends('layouts.app')

@section('content')
    <div class="panel-body">
        @include('common.errors')
        <div>
            <label for="name" class="control-label">First Name : </label>
            {{$employeeModel->employeeProfile->firstName}}
        </div>
        <div>
            <label for="name" class="control-label">Last Name : </label>
            {{$employeeModel->employeeProfile->lastName}}
        </div>
        <div>
            <label for="name" class="control-label">Hire Date : </label>
            {{$employeeModel->employeeProfile->hireDate}}
        </div>
         <div>
            <label for="name" class="control-label">Job Title : </label>
            {{$employeeModel->employeeProfile->jobTitle}}
        </div>
         <div>
            <label for="name" class="control-label">Annual Salary : </label>
            {{$employeeModel->employeeProfile->annualSalary}}
        </div>
         <div>
            <label for="name" class="control-label">Hourly Rate : </label>
            {{$employeeModel->employeeProfile->hourlyRate}}
        </div>
        <div>
            <label for="name" class="control-label">Overtime Rate : </label>
            {{$employeeModel->employeeProfile->overTimeRate}}
        </div>
        <div>
            <label for="name" class="control-label">streetLine1 : </label>
            {{$employeeModel->employeeProfile->streetLine1}}
        </div>
        <div>
            <label for="name" class="control-label">streetLine2 : </label>
            {{$employeeModel->employeeProfile->streetLine2}}
        </div>
        <div>
            <label for="name" class="control-label">country : </label>
            {{$employeeModel->employeeProfile->country}}
        </div>
        <div>
            <label for="name" class="control-label">state / Province : </label>
            {{$employeeModel->employeeProfile->stateProvince}}
        </div>

        <div>
            <label for="name" class="control-label">city : </label>
            {{$employeeModel->employeeProfile->city}}
        </div>
        <div>
            <label for="name" class="control-label">Departments : </label>
            @foreach ($employeeModel->employeeDepartmentIds as $departmentName)
                {{$departmentName}}
                {{ "|" }}
            @endforeach
        </div>
        <label for="name" class="control-label">Hours Worked : </label>

        {{$employeeModel->totalHoursWorked()}}

        <form action="{{ url('employees/'.$employeeModel->employeeProfile->employeeId.'/edit') }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('GET') }}
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash">EDIT</i>
            </button>
        </form>
        <div>
            Employee is
            @if(!isset($employeeModel->isWorkingOverTime))
                Not
            @endif
            Working Over Time.

        </div>

    @include('employees/showEmployeeClientProjects')
    @include('employees/showEmployeeCompanyProjects')

@endsection