@extends('layouts.app')

@section('content')

<div class="panel-body">
    <!-- Display Validation Errors -->
@include('common.errors')

    @if (count($usersWithRoles)>0 )
        <div class="panel panel-default">
            <div class="panel-heading">
               <h1> Current Users With Roles </h1>
            </div>
           {{--  <div class="panel-heading">
                  <a href="/roles/create/">
                    <button type="button" class="btn btn-primary"> </button>
                  </a>

            </div> --}}
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Roles</th>
                    <th>Operations</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($usersWithRoles as $userWithRoles)
                        <tr>
                        
                            <td class="table-text">
                                <div>
                                    {{ $userWithRoles->name}}
                                </div>

                            </td>
                             <td class="table-text">
                                <div>
                                    {{ $userWithRoles->email}}
                                </div>

                            </td>

                             <td class="table-text">

                             @foreach($userWithRoles->roles as $userRole)
                               @if($userRole->name)
                                <div>
                                    {{ $userRole->name}}
                                </div>
                               @else
                               No Role Assigned

                               @endif 

                             @endforeach
                            </td>

                            <td>
                                <a href="/user-roles/{{$userWithRoles->id}}/edit">
                                    <button type="button" class="btn btn-primary"> Edit </button>
                                </a>

                                <form action="{{ url('user-roles/'.$userWithRoles->id) }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger" data-toggle="confirmation" data-singleton="true" type="submit">
                                    <i class="fa fa-trash">
                                        Delete
                                    </i>
                                     </button>
                                   
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>

@endif
<script type="text/javascript">
$(document).ready(function(){ 

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
    });
</script>
@endsection

