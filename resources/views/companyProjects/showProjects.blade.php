 @if (count($company->projects) > 0)
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
                            @foreach ($company->projects as $company->project)
                                <tr>
                                    <!-- company->project Name -->
                                    <td class="table-text">
                                        <div>{{ $company->project->name }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $company->project->expectedStartDate }}</div>
                                    </td>
                                     <td class="table-text">
                                        <div>{{ $company->project->expectedEndDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $company->project->actualStartDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $company->project->actualEndDate }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $company->project->budget}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $company->project->cost }}</div>
                                    </td>

                                    <!-- Delete Button -->
                                    <td>
                           <form action="{{ url('companyprojects/'.$company->project->id) }}" method="POST">
                             {{ csrf_field() }}
                             {{ method_field('DELETE') }}
                             <input type="hidden" name="_method" value="DELETE">
                             <button type="submit" class="btn btn-danger">
                             <i class="fa fa-trash"> Delete </i>
                             </button>
                           </form>

                           <form action="{{ url('companyprojects/'.$company->project->id.'/edit') }}" method="POST">
                             {{ csrf_field() }}
                             {{ method_field('GET') }}

                              <button type="submit" class="btn btn-danger">
                              <i class="fa fa-trash"> View</i>
                              </button>
                            </form>

                          <form action="{{ url('companyprojectresources/'.$company->project->id) }}" method="POST">
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

