
@extends('layouts.app')

@section('content')
<div class="panel-body">
    @include('common.errors')
    <div>

        <label for="name" class="control-label">Name : </label>


            {{$employeeModel->firstName}}

    </div>
    <div>

        <label for="name" class="control-label">Last Name : </label>


            {{$employeeModel->lastName}}

    </div>
    <div>

        <label for="name" class="control-label">Hire Date : </label>


            {{$employeeModel->hireDate}}

    </div>

    <div>

        <label for="name" class="control-label">Overtime Rate : </label>


            {{$employeeModel->overTimeRate}}

    </div>
    <div>

        <label for="name" class="control-label">streetLine1 : </label>
            {{$employeeModel->streetLine1}}
    </div>
      <div>

        <label for="name" class="control-label">streetLine2 : </label>


            {{$employeeModel->streetLine2}}

    </div>

    <div>

        <label for="name" class="control-label">country : </label>


            {{$employeeModel->country}}

    </div>

    <div>

        <label for="name" class="control-label">state / Province : </label>


            {{$employeeModel->stateProvince}}

    </div>

     <div>

        <label for="name" class="control-label">city : </label>


            {{$employeeModel->city}}

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



      <form action="{{ url('employees/'.$employeeModel->employeeId.'/edit') }}" method="POST">
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