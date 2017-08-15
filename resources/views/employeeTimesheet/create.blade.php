<div class="panel panel-default">
    @if($errors->any())
    <h4>
        {{$errors->first()}}
    </h4>
    @endif
    <div class="panel-heading" id="timeSheetDateDiv">
        <h3>
            TimeSheet
        </h3>
        <input class="" id="timesheetDate" name="timesheetDate" required="" type="week">
            Select Date
        </input>
    </div>
    <input name="employeeId" type="hidden" value="{{$employeeId}}">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th id="monDiv">
                        Mon
                    </th>
                    <th id="tueDiv">
                        Tue
                    </th>
                    <th id="wedDiv">
                        Wed
                    </th>
                    <th id="thurDiv">
                        Thur
                    </th>
                    <th id="friDiv">
                        Friday
                    </th>
                    <th id="satDiv">
                        Sat
                    </th>
                    <th id="sunDiv">
                        Sun
                    </th>
                    <th id="sumDiv">
                        Sum
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr id="billable">
                    <th scope="row">
                        Billable
                    </th>
                    <td>
                        <input class="form-control input-sm " id="mondayBillable" min="0" name="mondayBillable" required="" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="tuesdayBillable" min="0" name="tuesdayBillable" required="" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="wednesdayBillable" min="0" name="wednesdayBillable" required="" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="thursdayBillable" min="0" name="thursdayBillable" required="" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="fridayBillable" min="0" name="fridayBillable" required="" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="saturdayBillable" min="0" name="saturdayBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="sundayBillable" min="0" name="sundayBillable" type="number"/>
                    </td>
                    <td id="sumBillable">
                    </td>
                </tr>
                <tr nonbillable="">
                    <th scope="row">
                        Non Billable
                    </th>
                    <td>
                        <input class="form-control input-sm " id="mondayNonBillable" min="0" name="mondayNonBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="tuesdayNonBillable" min="0" name="tuesdayNonBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="wednesdayNonBillable" min="0" name="wednesdayNonBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="thursdayNonBillable" min="0" name="thursdayNonBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="fridayNonBillable" min="0" name="fridayNonBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="saturdayNonBillable" min="0" name="saturdayNonBillable" type="number"/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="sundayNonBillable" min="0" name="sundayNonBillable" type="number"/>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-trash">
                Add TimeSheet
            </i>
        </button>
    </input>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#sumBillable").html(0);
        $("#sumBillable").val(0);
        var sum=0;
        $("#timesheetDate").change(function () {
            var timesheetDate = $("#timesheetDate").val();
            var employeeId = $("#employeeId").val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: '/employeetimesheet/timesheet/getweekdates',
                data: {
                    '_token': CSRF_TOKEN,
                    'timesheetDate': timesheetDate,
                    'employeeId': employeeId,
                },
                success: function (data) {
                    if (data.isAlreadyEntered == true) {
                        $("#alreadyEnteredMessage").remove();
                        html = '<div id="alreadyEnteredMessage">You Have already entered timesheet for week ' + timesheetDate + '</div>';
                        $("#timeSheetDateDiv").before(html);
                        $("#timesheetDate").val(null);

                    }
                    if (data.isAlreadyEntered == false) {
                        $("#alreadyEnteredMessage").remove();
                        var monDiv = 'Mon (' + data.week.monday + ')';
                        $("#monDiv").html(monDiv);

                        var tueDiv = 'Tue (' + data.week.tuesday + ')';
                        $("#tueDiv").html(tueDiv);
                        var wedDiv = 'Wed (' + data.week.wednesday + ')';
                        $("#wedDiv").html(wedDiv);
                        var thurDiv = 'Thur (' + data.week.thursday + ')';
                        $("#thurDiv").html(thurDiv);
                        var friDiv = 'Friday (' + data.week.friday + ')';
                        $("#friDiv").html(friDiv);
                        //var mon = 'Sat (' + data.week.saturday + ')';
                        var satDiv = 'Sat (' + data.week.saturday + ')';
                        $("#satDiv").html(satDiv);
                        // var mon = 'Mon (' + data.week.monday + ')';
                        var sunDiv = 'sun (' + data.week.sunday + ')';
                        $("#sunDiv").html(sunDiv);
                    }

                },
                error: function () {
                    alert("Bad submit ");
                }
            });

        });

         $("#billable").change(function () {
            // $("#sumBillable").html(0);
            var sumBillable=$("#sumBillable").val();
            sum=sum+sumBillable;

                       var monDivVal=$("#monDiv").val();

                       var tueDivVal = $("#tueDiv").val();

                       var wedDiv = $("#wedDiv").val();

                       var thurDivVal $("#thurDiv").val();

                       var friDivVal =$("#friDiv").val();

                       var satDivVal = $("#satDiv").val();

                       var sunDivVal = $("#sunDiv").val();

    });
    });
</script>
@section('pageSpecificScripts')
@endsection
