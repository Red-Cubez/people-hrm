@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clientProject Form -->
        <form action="{{url('clientprojects') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Project Name -->
            <input type="hidden" name="clientid" value="{{$clientid}}">
                <div class="form-group">
                <label for="clientProject" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" >
                </div>
            </div>
            <div class="form-group">
            <label for="clientProject" class="col-sm-3 control-label">Expected Start Date</label>

                <div class="col-sm-6">
                    <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control">
                </div>
                </div>
                <div class="form-group">
            <label for="clientProject" class="col-sm-3 control-label">Expected End Date</label>

                <div class="col-sm-6">
                    <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control">
                </div>
                </div>
                <div class="form-group">
            <label for="clientProject" class="col-sm-3 control-label">Actual Start Date</label>

                <div class="col-sm-6">
                    <input type="date" name="actualStartDate" id="actualStartDate" class="form-control">
                </div>
                </div>
                <div class="form-group">
            <label for="clientProject" class="col-sm-3 control-label">Actual End Date</label>

                <div class="col-sm-6">
                    <input type="date" name="actualEndDate" id="actualEndDate" class="form-control">
                </div>
                </div>
                <div class="form-group">
            <label for="clientProject" class="col-sm-3 control-label">Budget</label>

                <div class="col-sm-6">
                    <input type="number" name="budget" id="budget" class="form-control">
                </div>
                </div>
                <div class="form-group">
            <label for="clientProject" class="col-sm-3 control-label">Cost</label>

                <div class="col-sm-6">
                    <input type="number" name="cost" id="cost" class="form-control">
                </div>
                </div>
            <!-- Add clientProject Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"> Add Project </i>
                    </button>
                </div>
            </div>
        </form>
    </div>
        <!-- Current clientProjects -->
    @if (count($clientProjects) > 0)
          <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Current Projects</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                        <th>Name </th>
                        <th>Expected Start Date</th>
                        <th>Expected End Date</th>
                        <th>Actual Start Date</th>
                        <th>Actual End Date</th>
                        <th>Budget</th>
                        <th>Cost</th>
                        <th>Operations</th>

                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($clientProjects as $clientProject)
                            <tr>
                                <!-- clientProject Name -->
                                <td class="table-text">
                                    <div>{{ $clientProject->name }}</div>
                                </td>
                                 <td class="table-text">
                                    <div>{{ $clientProject->expectedStartDate }}</div>
                                </td>
                                 <td class="table-text">
                                    <div>{{ $clientProject->expectedEndDate }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $clientProject->actualStartDate }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $clientProject->actualEndDate }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $clientProject->budget }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $clientProject->cost }}</div>
                                </td>
                               
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('clientprojects/'.$clientProject->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"> Delete </i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    @endif
@endsection