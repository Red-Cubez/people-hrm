<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">
        <div class="scroll-panel-table table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th># of Days</th>
            </thead>
            <tbody id="holidayTableBody">
            @if (count($companyHolidays) > 0)
                @foreach ($companyHolidays as $companyHoliday)
                    <tr >
                        <td id="holidayName_{{$companyHoliday->holidayId}}" >
                            {{ $companyHoliday->name }}
                        </td>
                        <td id="startDate_{{$companyHoliday->holidayId}}">
                            {{ $companyHoliday->startDate }}
                        </td>
                        <td id="endDate_{{$companyHoliday->holidayId}}" >
                            {{ $companyHoliday->endDate }}
                        </td>
                        <td id="countHolidays_{{$companyHoliday->holidayId}}" >

                                {{ $companyHoliday->holidays }}
                        </td>
                @endforeach
            @endif
            </tbody>
        </table>
        </div>
    </div>
</div>