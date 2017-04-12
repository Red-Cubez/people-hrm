@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <!-- New client Form -->
        <form action="{{url('clients') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- client Name -->
           @include('clients/clientForm')
        </form>
    </div>
        <!-- Current clients -->
    @if (count($clients) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Current Clients</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                        <th>Name </th>
                        <th>Contact Number</th>
                        <th>Contact Email</th>
                        <th>Contact Person</th>
                        <th>Operations</th>

                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                            <td class="table-text"><div>{{ $client->name }}</div></td>
                            <td class="table-text"><div>{{ $client->contactNumber }}</div></td>
                            <td class="table-text"><div>{{ $client->contactEmail }}</div></td>
                            <td class="table-text"><div>{{ $client->contactPerson }}</div></td>
                            <td>
                                        <form action="{{ url('clients/'.$client->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"> Delete</i>
                                        </button>
                                    </form>

                                        <form action="{{ url('clients/'.$client->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"> Update</i>
                                        </button>
                                    </form>

                                    <form action="{{ url('/clients/'.$client->id .'/clientprojects') }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                         
                                        
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"> Manage Projects</i>
                                        </button>  
                                    </form>
                                       
                                   
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection