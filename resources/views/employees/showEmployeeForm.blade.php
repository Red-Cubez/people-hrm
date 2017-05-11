
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


            {{$departments[1]->name}}

    </div>

      <form action="{{ url('employees/'.$employee->id.'/edit') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash">EDIT</i>
                            </button>
      </form>

@endsection