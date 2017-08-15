<div class="panel panel-default">
    <div class="panel-heading" id="timeSheetDateDiv">
        <h3>
            TimeSheet
        </h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th id="monDiv">
                    Mon ({{$weekDates['monday']}})
                </th>
                <th id="tueDiv">
                    Tue ({{$weekDates['tuesday']}})
                </th>
                <th id="wedDiv">
                    Wed ({{$weekDates['wednesday']}})
                </th>
                <th id="thurDiv">
                    Thur ({{$weekDates['thursday']}})
                </th>
                <th id="friDiv">
                    Friday ({{$weekDates['friday']}})
                </th>
                <th id="satDiv">
                    Sat ({{$weekDates['saturday']}})
                </th>
                <th id="sunDiv">
                    Sun ({{$weekDates['sunday']}})
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    Billable
                </th>
                <td>
                    {{$billableWeeklyTimesheet['monday']}}
                </td>
                <td>
                    {{$billableWeeklyTimesheet['tuesday']}}
                </td>
                <td>
                    {{$billableWeeklyTimesheet['wednesday']}}
                </td>
                <td>
                    {{$billableWeeklyTimesheet['thursday']}}
                </td>
                <td>
                    {{$billableWeeklyTimesheet['friday']}}
                </td>
                <td>
                    {{$billableWeeklyTimesheet['saturday']}}
                </td>
                <td>
                    {{$billableWeeklyTimesheet['sunday']}}
                </td>
            </tr>
            <tr>
                <th scope="row">
                    Non Billable
                </th>
                <td>
                    {{$nonBillableWeeklyTimesheet['monday']}}
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['tuesday']}}
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['wednesday']}}
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['thursday']}}
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['friday']}}
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['saturday']}}
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['sunday']}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
