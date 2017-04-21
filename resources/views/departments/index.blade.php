@extends('layouts.app')
@section('content')
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Department Form -->
    <form action="{{url('departments') }}"
        method="POST"
        class="form-horizontal">
        {{ csrf_field() }}
    @include('departments/departmentForm')

    </form>
</div>
<!-- Current Departments -->
@if (count($departments) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        {{-- display all current departments --}}
        <h3> Current Departments </h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th> Name </th>
           </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($departments as $department)
                <tr>
                    <!-- Department Name -->
                    <td class="table-text">
                        <div> {{ $department->name }}</div>
                    </td>
                    
                    <!-- Delete Button -->
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