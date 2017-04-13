    @extends('layouts.app')

    @section('content')

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New clientProject Form -->
            <form action="{{url('clientprojects') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

               <div class="form-group" >
               <input type="hidden" name="clientid" value="{{$clientid}}">
               </div>
                @include('clientProjects/clientProjectForm')

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
                                         
                                         <form action="{{ url('clientprojects/'.$clientProject->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('GET') }}
                                            
                                            <button type="submit" class="btn btn-danger">
                                               <i class="fa fa-trash"> Update</i> 
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