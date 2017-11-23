@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form action="{{url('departments') }}"
              method="POST"
              class="form-horizontal">
            {{ csrf_field() }}
            @include('departments/departmentForm')
        </form>
    </div>
    @if (count($departments) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3> Current Departments </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th> Name</th>
                    </thead>
                    <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td class="table-text">
                                <div> {{ $department->name }}</div>
                            </td>
                            <td>
                                <form action="{{ url('departments/'.$department->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('GET') }}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash">UPDATE</i>
                                    </button>
                                </form>
                                <form action="{{ url('departments/'.$department->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash">DELETE</i>
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