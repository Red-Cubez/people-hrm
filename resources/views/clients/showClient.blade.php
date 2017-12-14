@extends('layouts.app')

@section('content')
@permission(StandardPermissions::viewClient)
<main class="showClientSection">
     <div class="container">
         <div class="row">
             <div class="col-xs-12">
                 <div class="panel-body">
                     <div class="col-md-6 col-md-offset-3">
                         <ul class="list-group">
                             <li class="list-group-item">
                                  <label class="control-label" for="name">
                                  Name :
                                  </label>
                                  {{$client->name}}
                             </li>
                             <li class="list-group-item">
                                 <label class="control-label" for="contactPerson">
                                 Contact Person :
                                 </label>
                                  {{$client->contactPerson}} 
                             </li>
                             <li class="list-group-item">
                                  <label class="control-label" for="contactNumber">
                                  Contact Number :
                                 </label>
                                  {{$client->contactNumber}}
                             </li>
                             <li class="list-group-item">
                                    <label class="control-label" for="contactEmail">
                                    Contact Email :
                                    </label>
                                    {{$client->contactEmail}}
                             </li>
                             <li class="list-group-item">
                                <label class="control-label" for="contactPerson">
                                 Street Line 1 :
                               </label>
                               @if(isset($client->address->streetLine1))
                               {{$client->address->streetLine1 }}
                               @endif  
                             </li>
                             <li class="list-group-item">
                                 <label class="control-label" for="contactPerson">
                                 Street Line 2 :
                                </label>
                               @if(isset($client->address->streetLine2))
                                {{$client->address->streetLine2 }}
                               @endif
                             </li>
                             <li class="list-group-item">
                             <label class="control-label" for="contactPerson">
                               City
                             </label>
                              @if(isset($client->address->city))
                              {{$client->address->city }}
                              @endif
                                 <label class="control-label" for="contactPerson">
                                City
                              </label>
                              @if(isset($client->address->city))
                               {{$client->address->city }}
                               @endif
                             </li>
                             <li class="list-group-item">
                                 <label class="control-label" for="contactPerson">
                                  State / Province :
                                 </label>
                                 @if(isset($client->address->province))
                                 {{$client->address->stateProvince }}
                                  @endif
                             </li>
                             <li class="list-group-item">
                                 <label class="control-label" for="contactPerson">
                                 Country:
                                </label>
                                @if(isset($client->address->country))
                                {{$client->address->country }}
                               @endif
                             </li>
                             @permission([StandardPermissions::createEditClient,StandardPermissions::deleteClient])
                             <li class="list-group-item">
                                  
                                  <div class="aParent ">
                                      @permission(StandardPermissions::createEditClient)
                                          <a href="/clients/{{$client->id}}/edit"  >
                                            <button class="button20 "  > 
                                              <i class="fa fa-pencil-square-o fa-2x"></i>
                                            </button>
                                          </a>
                                      @endpermission
                                      @permission(StandardPermissions::deleteClient)
                                          <form action="{{ url('clients/'.$client->id) }}" method="POST">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE') }}
                                              <input name="_method" type="hidden" value="DELETE">
                                              <button class="button20 " data-toggle="confirmation" data-singleton="true" type="submit">
                                                   <i class="fa fa-trash fa-2x"></i>
                                              </button>
                                              </input>
                                          </form>
                                      @endpermission
                                  </div>
                             </li>
                            @endpermission
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
        @include('common.errors')
        @permission(StandardPermissions::createEditClientProject) 
       <div class="row row-content100">
       <div class="col-xs-12 col-md-7 col-md-offset-5">
        <a href="/clients/{{$client->id}}/createproject">
            <button class="button button40"> Add New Project

            </button></a>
            </div>
            </div>
        @endpermission
    </div>
</main>
@include('clientProjects/showProjects')
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>
@endpermission
@endsection
