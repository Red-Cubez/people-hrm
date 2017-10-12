@extends('layouts.app')

@section('content')
@permission(StandardPermissions::viewClient)
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
            @if(isset($client->address->streetLine1))
            {{$client->address->streetLine1 }}
            @endif
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                Street Line 2 :
            </label>
            @if(isset($client->address->streetLine2))
            {{$client->address->streetLine2 }}
            @endif
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                City
            </label>
             @if(isset($client->address->city))
            {{$client->address->city }}
            @endif
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                State / Province :
            </label>
              @if(isset($client->address->province))
            {{$client->address->stateProvince }}
            @endif
        </div>
        <div>
            <label class="control-label" for="contactPerson">
                Country:
            </label>
              @if(isset($client->address->country))
            {{$client->address->country }}
            @endif
        </div>
        @permission(StandardPermissions::createEditClient)
        <div>
        <a href="/clients/{{$client->id}}/edit">
            <button class="btn btn-primary"> Edit

            </button></a>
        </div>
        @endpermission
        @permission(StandardPermissions::deleteClient)
        <div>
        <form action="{{ url('clients/'.$client->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger " data-toggle="confirmation" data-singleton="true" type="submit">
                    Delete
            </button>
            </input>
        </form>
        </div>
         @endpermission
         
       @permission(StandardPermissions::createEditClientProject) 
        <a href="/clients/{{$client->id}}/createproject">
            <button class="btn btn-primary"> Add New Project

            </button></a>
        @endpermission
    </div>
    @include('clientProjects/showProjects')
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>
@endpermission
@endsection
