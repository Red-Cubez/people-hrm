<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">

        <table class="table table-striped ">
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
                        <!--  Name -->
                        <td id="holidayName_{{$companyHoliday->holidayId}}" >
                            <div>
                                {{ $companyHoliday->name }}
                            </div>
                        </td>
                        <td id="startDate_{{$companyHoliday->holidayId}}">
                            <div>
                                {{ $companyHoliday->startDate }}
                            </div>
                        </td>
                        <td id="endDate_{{$companyHoliday->holidayId}}" >
                            <div>
                                {{ $companyHoliday->endDate }}
                            </div>
                        </td>
                        <td id="countHolidays_{{$companyHoliday->holidayId}}" >
                            <div>
                                {{ $companyHoliday->holidays }}
                            </div>
                        </td>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

</div>