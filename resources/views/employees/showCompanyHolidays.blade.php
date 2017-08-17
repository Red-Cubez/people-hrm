<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Company Holidays
        </h3>
    </div>
    <div class="panel-body">

        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
            <th>
                Holiday Name
            </th>
            <th>
                Start Date
            </th>
            <th>
                End Date
            </th>
            <th>
                Total Holidays
            </th>
            </thead>
            <!-- Table Body -->
            <tbody id="holidayTableBody">
            @if (count($companyHolidays) > 0)
                @foreach ($companyHolidays as $companyHoliday)
                    <tr >
                        <!--  Name -->
                        <td id="holidayName_{{$companyHoliday->holidayId}}" class="table-text">
                            <div>
                                {{ $companyHoliday->name }}
                            </div>
                        </td>
                        <td id="startDate_{{$companyHoliday->holidayId}}" class="table-text">
                            <div>
                                {{ $companyHoliday->startDate }}
                            </div>
                        </td>
                        <td id="endDate_{{$companyHoliday->holidayId}}" class="table-text">
                            <div>
                                {{ $companyHoliday->endDate }}
                            </div>
                        </td>
                        <td id="countHolidays_{{$companyHoliday->holidayId}}" class="table-text">
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