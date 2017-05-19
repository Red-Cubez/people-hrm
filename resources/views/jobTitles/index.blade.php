@extends('layouts.app')
@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')
    <!-- New Job Title Form -->


        <form action="{{url('jobtitle') }}"

              method="POST"
              class="form-horizontal">
            <input type="hidden" name="companyId" id="companyId" value="{{$companyId}}" >
            {{ csrf_field() }}
            @include('jobTitles/addJobTitleForm')
        </form>

    </div>
    <!-- Current Job Titles -->
    @if (count($jobTitles) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{-- display all company job titles --}}
                <h3> Current Company's Job Titles </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                    <th> Name</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($jobTitles as $jobTitle)
                        <tr>
                            <!--jobTitles Name -->
                            <td class="table-text">
                                <div> {{ $jobTitle->title }}</div>
                            </td>

                            <!-- Delete Button -->
                            <td>

                                <form action="{{ url('jobtitle/'.$jobTitle->id.'/edit') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('GET') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash">Edit</i>
                                    </button>
                                </form>
                                <form action="{{ url('jobtitle/'.$jobTitle->id) }}" method="POST">
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

    @endif

@endsection