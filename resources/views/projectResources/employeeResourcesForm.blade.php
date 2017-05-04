@if (count($availableEmployees) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Current Available Employees
      </div>
        <div class="panel-body">
           <table class="table table-striped task-table">
              <!-- Table Headings -->
              <thead>
                <th>Employees</th>
                <th>&nbsp;</th>
              </thead>
               <!-- Table Body -->
               <tbody>
                 @foreach ($availableEmployees as $availableEmployee)
                  <tr>
                    <!-- clientProject Name -->
                        <td class="table-text">
                           <div>{{ $availableEmployee->firstName }}</div>
                        </td>
                    <!-- Delete Button -->
                        <td>
                          <form action="{{ url('projectresources/') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}">
                            <input type="hidden" name="employee_id" value="{{$availableEmployee->id }}">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Add 
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