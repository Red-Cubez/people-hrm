@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New client Form -->
        <form action="{{url('clients') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- client Name -->
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">

                </div>
            </div>
            
            <div class="form-group">
                <label for="contactNumber" class="col-sm-3 control-label">Contact Number</label>

                <div class="col-sm-6">
                    <input type="Number" name="contactNumber" id="contactNumber" class="form-control">
                    
                </div>
            </div>

            <div class="form-group">
                <label for="contactEmail" class="col-sm-3 control-label">Contact Email</label>

                <div class="col-sm-6">
                    <input type="Email" name="contactEmail" id="contactEmail" class="form-control">
                    
                </div>
            </div>

            <div class="form-group">
                <label for="contactPerson" class="col-sm-3 control-label">Contact Person</label>

                <div class="col-sm-6">
                    <input type="text" name="contactPerson" id="contactPerson" class="form-control">
                    
                </div>
            </div>

            <!-- Add client Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add client
                    </button>
                </div>
            </div>
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
                        <th>Contact Number  </th>
                        <th>Contact Email   </th>
                        <th>Contact Person  </th>
                        <th>Operations      </th>
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
                                            <i class="fa fa-trash"></i> Delete
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