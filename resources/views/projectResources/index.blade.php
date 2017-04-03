@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clientProject Form -->
        <form action="{{url('projectresources') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Resource Name -->
            <div class="form-group">
                <label for="clientProject" class="col-sm-3 control-label">Resource</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>

            <!-- Add Project Resource Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Resource
                    </button>
                </div>
            </div>
        </form>
    </div>
        <!-- Current Resources -->
    @if (count($projectResources) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Resources
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                        <th>Project</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($projectResources as $projectResource)
                            <tr>
                                <!-- clientProject Name -->
                                <td class="table-text">
                                    <div>{{ $projectResource->name }}</div>
                                </td>
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('$projectresources'.$projectResource->id) }}" method="POST">
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