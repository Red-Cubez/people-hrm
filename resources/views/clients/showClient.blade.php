@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @include('common.errors')
        <div>
            <label class="control-label" for="name">
                Name :
            </label>
            {{$client->name}}
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                Contact Person :
            </label>
            {{$client->contactPerson}}
        </div>
        <div>
            <label class="control-label" for="contactNumber">
                Contact Number :
            </label>
            {{$client->contactNumber}}
        </div>
        <div>
            <label class="control-label" for="contactEmail">
                Contact Email :
            </label>
            {{$client->contactEmail}}
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                Street Line 1 :
            </label>
            {{$client->address->streetLine1 }}
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                Street Line 2 :
            </label>
            {{$client->address->streetLine2 }}
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                City
            </label>
            {{$client->address->city }}
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                State / Province :
            </label>
            {{$client->address->stateProvince }}
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                Country:
            </label>
            {{$client->address->country }}
        </div>
        <a href="/clients/{{$client->id}}/edit">
            <button class="btn btn-primary"> Edit

            </button></a>
        {{--<form action="{{ url('clients/'.$client->id.'/edit') }}" method="POST">--}}
            {{--{{ csrf_field() }}--}}
            {{--{{ method_field('GET') }}--}}
            {{--<input type="hidden" name="companyId" value="{{$companyId}}">--}}
            {{--<button class="btn btn-primary" type="submit">--}}
                {{--<i class="fa fa-trash">--}}
                    {{--Edit--}}
                {{--</i>--}}
            {{--</button>--}}
        {{--</form>--}}
        <form action="{{ url('clients/'.$client->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">

                    Delete

            </button>
            </input>
        </form>
        <a href="/clients/{{$client->id}}/clientprojects">
            <button class="btn btn-primary"> Add New Project

            </button></a>
        {{--<form action="{{ url('/clients/'.$client->id.'/clientprojects') }}" method="POST">--}}
            {{--{{ csrf_field() }}--}}
            {{--{{ method_field('GET') }}--}}
            {{--<button class="btn btn-primary" type="submit">--}}
                {{--<i class="fa fa-trash">--}}
                    {{--Add New Project--}}
                {{--</i>--}}
            {{--</button>--}}
        {{--</form>--}}
    </div>
    @include('clientProjects/showProjects')

@endsection
