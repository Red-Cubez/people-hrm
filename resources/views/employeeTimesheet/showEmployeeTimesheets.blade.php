<div class="panel panel-default">
    <div class="panel-heading">
      @if(isset($timesheet))
        <h3>Timesheet</h3>
        @elseif(!isset($timesheet))
        <h3>Timesheets</h3>
      @endif
    </div>
    <div class="panel-body">
        @if (isset($timesheets) && count($timesheets)>0)
         <div class="scroll-panel-table table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
             <tr>
                <th>Week No and Year</th>
                <th>Week Start Date</th>
                <th>Week End Date</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($timesheets as $timesheet)
                <tr>
                    <td>
                     <a href="/employeetimesheet/{{$timesheet->id}}/edit"> {{$timesheet->weekNoAndYear}}</a>
                    </td>
                    <td>{{$timesheet->weekStartDate}}</td>
                    <td>{{$timesheet->weekEndDate}}</td>
                 </tr>
                @endforeach
            @else
            No Record Found
            @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
