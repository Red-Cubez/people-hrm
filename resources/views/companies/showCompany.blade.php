
@extends('layouts.app')

@section('content')

<div class="panel-body">
    @include('common.errors')
    <div>
        <label for="name" class="control-label">Name : </label>


            {{$company->name}}

    </div>
    <div>
        <label for="contactPerson" class="control-label">Street Line 1 : </label>

            {{$company->address->streetLine1 }}

    </div>
    <div>
        <label for="contactPerson" class="control-label">Street Line 2 : </label>

            {{$company->address->streetLine2 }}

    </div>
    <div>
        <label for="contactPerson" class="control-label">Country: </label>

            {{$company->address->country }}

    </div>
    <div>
        <label for="contactPerson" class="control-label">State / Province : </label>

             {{$company->address->stateProvince }}

    </div>

    <div>
        <label for="contactPerson" class="control-label">City</label>

            {{$company->address->city }}

    </div>

    <form action="{{ url('companies/'.$company->id.'/edit') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"> Edit</i>
                            </button>
    </form>

    <form action="{{ url('/companies/'.$company->id.'/companyprojects') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}


                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"> Add New Project</i>
                            </button>
                        </form>
                        
</div>
    @include('companyProjects/showProjects')

@endsection