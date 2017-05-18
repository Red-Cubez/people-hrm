
@extends('layouts.app')

@section('content')

<div class="panel-body">
    @include('common.errors')
    <div>
        <label for="name" class="control-label">Name : </label>


            {{$client->name}}

    </div>
    <div>
        <label for="contactNumber" class="control-label">Contact Number : </label>

            {{$client->contactNumber}}

    </div>

    <div>
        <label for="contactEmail" class="control-label">Contact Email : </label>

            {{$client->contactEmail}}

    </div>

    <div>
        <label for="contactPerson" class="control-label">Contact Person : </label>

              {{$client->contactPerson}}

    </div>

    <div>
        <label for="contactPerson" class="control-label">Street Line 1 : </label>

            {{$client->address->streetLine1 }}

    </div>
    <div>
        <label for="contactPerson" class="control-label">Street Line 2 : </label>

            {{$client->address->streetLine2 }}

    </div>
    <div>
        <label for="contactPerson" class="control-label">Country: </label>

            {{$client->address->country }}

    </div>
    <div>
        <label for="contactPerson" class="control-label">State / Province : </label>

             {{$client->address->stateProvince }}

    </div>

    <div>
        <label for="contactPerson" class="control-label">City</label>

            {{$client->address->city }}

    </div>

    <form action="{{ url('clients/'.$client->id.'/edit') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"> Edit</i>
                            </button>
    </form>

    <form action="{{ url('/clients/'.$client->id.'/clientprojects') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('GET') }}


                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"> Add New Project</i>
                            </button>
                        </form>

</div>
    @include('clientProjects/showProjects')

@endsection