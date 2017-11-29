@extends('layouts.app')
@section('content')
<section class="userRoleIndexSection">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel-body">
  @include('common.errors')
  @if (count($usersWithRoles)>0 )
        <div class="panel panel-default">
            <div class="panel-heading">
               <h1> Current Users With their Roles </h1>
            </div>
           {{--  <div class="panel-heading">
                  <a href="/roles/create/">
                    <button type="button" class="btn btn-primary"> </button>
                  </a>

            </div> --}}
            <div class="panel-body">
             <div class="scroll-panel-table table-responsive">
                <table class="table table-bordered table-hover table-striped">
                   <thead>
                   <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Roles</th>
                    <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($usersWithRoles as $userWithRoles)
                        <tr>
                        <td>  {{ $userWithRoles->name}}</td>
                         <td> {{ $userWithRoles->email}} </td>
                         <td  > 
                         @foreach($userWithRoles->roles as $userRole)
                               @if($userRole->name)
                                 {{ $userRole->name}}
                                 @else
                               No Role Assigned
                               @endif 
                              @endforeach
                            </td>
                             <td>
                             <div class="aParent">
                                <a href="/user-roles/{{$userWithRoles->id}}/edit">
                                    <button type="button" class="button button40"> Change Roles </button>
                                </a> 
                                <form action="{{ url('user-roles/'.$userWithRoles->id) }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="button20 pull-right" data-toggle="confirmation" data-singleton="true" type="submit">
                                    <i class="fa fa-trash fa-2x"> </i>
                                     </button>
                                   
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
</div>
      </div>
    </div>
  </div>
</section>


@endif
<script type="text/javascript">
$(document).ready(function(){ 

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
    });
</script>
@endsection

