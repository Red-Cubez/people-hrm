
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

        <label for="name" class="control-label">Departments : </label>

            {{--  @foreach ($departments as $department)
                    {{$department->name}}
                    {{ "|" }}
              @endforeach
 --}}
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