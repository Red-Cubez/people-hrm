
@extends('layouts.app')

@section('content')
<div class="panel-body">
    @include('common.errors')
    <div>

        <label for="name" class="control-label">Name : </label>


            {{$employee->firstName}}

    </div>
    <div>

        <label for="name" class="control-label">Last Name : </label>


            {{$employee->lastName}}

    </div>
    <div>

        <label for="name" class="control-label">Hire Date : </label>


            {{$employee->hireDate}}

    </div>

    <div>

        <label for="name" class="control-label">Overtime Rate : </label>


            {{$employee->overTimeRate}}

    </div>
    <div>

        <label for="name" class="control-label">streetLine1 : </label>


            {{$employee->address->streetLine1}}

    </div>

    <div>

        <label for="name" class="control-label">Departments : </label>

             @foreach ($departments as $department)
                    {{-- {{$department->name}} --}}
                    {{ "|" }}
              @endforeach

    </div>


        <label for="name" class="control-label">Hours Worked : </label>


            {{$sumOfTotalHoursWorked}}



      <form action="{{ url('employees/'.$employee->id.'/edit') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash">EDIT</i>
                            </button>
      </form>

      <div>

      Employee is
      @if(!isset($isWorkingOverTime))
      Not
      @endif Working Over Time.

      </div>

      @include('employees/showEmployeeClientProjectsForm')
      @include('employees/showEmployeeCompanyProjectsForm')

@endsection