@extends('layouts.app')

@section('content')

<div class="panel-body">
    <!-- Display Validation Errors -->
@include('common.errors')

    @if (count($roles)>0 )
        <div class="panel panel-default">
            <div class="panel-heading">
               <h1> Current Roles </h1>
            </div>
            <div class="panel-heading">
                  <a href="/roles/create">
                    <button type="button" class="btn btn-primary"> Add New Role </button>
                  </a>

            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Operations</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <!-- clientProject Name -->
                            <td class="table-text">
                                <div>
                                    {{ $role->name}}
                                </div>

                            </td>
                             <td class="table-text">
                                <div>
                                    {{ $role->display_name}}
                                </div>

                            </td>
                             <td class="table-text">
                                <div>
                                    {{ $role->description}}
                                </div>

                            </td>

                            <td>
                                <a href="/roles/{{$role->id}}/edit">
                                    <button type="button" class="btn btn-primary"> Edit </button>
                                </a>

                                <form action="{{ url('roles/'.$role->id) }}"
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

