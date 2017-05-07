 @if (count($companyProjects) > 0)
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
                            @foreach ($companyProjects as $companyProject)
                                <tr>
                                    <!-- companyProject Name -->
                                    <td class="table-text">
                                        <div>{{ $companyProject->name }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $companyProject->expectedStartDate }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $companyProject->expectedEndDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $companyProject->actualStartDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $companyProject->actualEndDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $companyProject->budget}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $companyProject->cost }}</div>
                                    </td>

                                    <!-- Delete Button -->
                                    <td>
                           <form action="{{ url('companyprojects/'.$companyProject->id) }}" method="POST">
                             {{ csrf_field() }}
                             {{ method_field('DELETE') }}
                             <input type="hidden" name="_method" value="DELETE">
                             <button type="submit" class="btn btn-danger">
                             <i class="fa fa-trash"> Delete </i>
                             </button>
                           </form>

                           <form action="{{ url('companyprojects/'.$companyProject->id) }}" method="POST">
                             {{ csrf_field() }}
                             {{ method_field('GET') }}

                              <button type="submit" class="btn btn-danger">
                              <i class="fa fa-trash"> Update</i>
                              </button>
                            </form>

                          <form action="{{ url('companyprojects/'.$companyProject->id.'/projectresources') }}" method="POST">
                             {{ csrf_field() }}
                             {{ method_field('GET') }}

                              <button type="submit" class="btn btn-danger">
                              <i class="fa fa-trash"> Manage Resource</i>
                              </button>
                           </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @endif