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
                <label for="client" class="col-sm-3 control-label">client</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">
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
                Current clients
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                        <th>Client</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <!-- client Name -->
                                <td class="table-text">
                                    <div>{{ $client->name }}</div>
                                </td>
                                <!-- Delete Button -->
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