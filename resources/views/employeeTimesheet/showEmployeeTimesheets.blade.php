<div class="panel panel-default">
    <div class="panel-heading">
      @if(isset($timesheet))
        <h3>
            Timesheet
        </h3>

       @elseif(!isset($timesheet))
        <h3>
            Timesheets
        </h3>
      @endif
    </div>
    <div class="panel-body">
        @if (isset($timesheets) && count($timesheets)>0)
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
                <th>
                    Week No and Year
                </th>
                <th>
                    Week Start Date
                </th>
                <th>
                    Week End Date
                </th>
            </thead>
            <tbody>
                @foreach ($timesheets as $timesheet)
                <tr>
                    <td class="table-text">
                        <div>
                            <a href="/employeetimesheet/{{$timesheet->id}}/edit">
                                {{$timesheet->weekNoAndYear}}
                            </a>
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                            {{$timesheet->weekStartDate}}
                        </div>
                    </td>
                    <td class="table-text">
                        <div>
                              {{$timesheet->weekEndDate}}
                        </div>
                    </td>
                  
                    </td>
                </tr>
                @endforeach
            @else
            No Record Found
            @endif
            </tbody>
        </table>
    </div>
   
</div>
