
<div class="panel panel-default">
    <div class="panel-heading" id="timeSheetDateDiv">
        <h3>
            TimeSheet
        </h3>
    </div>
    <?php $billableSum = 0;
$nonBillableSum = 0;
?>
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
                <th id="sumDiv">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            <tr id="billable">
                <th scope="row">
                    Billable
                </th>
                <td>
                    {{$billableWeeklyTimesheet['monday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['monday'];?>
                </td>
                <td>
                    {{$billableWeeklyTimesheet['tuesday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['tuesday'];?>
                </td>
                <td>
                    {{$billableWeeklyTimesheet['wednesday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['wednesday'];?>
                </td>
                <td>
                    {{$billableWeeklyTimesheet['thursday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['thursday'];?>
                </td>
                <td>
                    {{$billableWeeklyTimesheet['friday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['friday'];?>
                </td>
                <td>
                    {{$billableWeeklyTimesheet['saturday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['saturday'];?>
                </td>
                <td>
                    {{$billableWeeklyTimesheet['sunday']}}
                    <?php $billableSum = $billableSum + $billableWeeklyTimesheet['sunday'];?>
                </td>
                <td id="sumBillable">
                </td>
            </tr>
            <tr id="nonbillable">
                <th scope="row">
                    Non Billable
                </th>
                <td>
                    {{$nonBillableWeeklyTimesheet['monday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['monday'];?>
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['tuesday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['tuesday'];?>
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['wednesday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['wednesday'];?>
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['thursday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['thursday'];?>
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['friday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['friday'];?>
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['saturday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['saturday'];?>
                </td>
                <td>
                    {{$nonBillableWeeklyTimesheet['sunday']}}
                    <?php $nonBillableSum = $nonBillableSum + $nonBillableWeeklyTimesheet['sunday'];?>
                </td>
                <td id="sumNonBillable">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
         var sum={{$billableSum }}
         $("#sumBillable").html(sum);

         var sum= {{$nonBillableSum}}
         $("#sumNonBillable").html(sum);
    });
</script>
@section('pageSpecificScripts')
@endsection
