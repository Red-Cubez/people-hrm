<div class="panel panel-default">
    @if(count($errors)>0)
        <div class="col-md-12 pull-left">
            <div class="form-group ">
                <div class="alert alert-error">
                    <ul>
                    @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="panel-heading" id="timeSheetDateDiv">
        <h3>
            TimeSheet
        </h3>
        Select Date
        <input class="" id="timesheetDate" name="timesheetDate" required="" type="week">

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
                <tr id="nonbillable">
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
                     <td id="sumNonBillable">
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
         $("#sumNonBillable").html(0);
        $("#sumNonBillable").val(0);
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

                       var mondayBillable=$("#mondayBillable").val();

                       var tuesdayBillable = $("#tuesdayBillable").val();

                       var wednesdayBillable =$("#wednesdayBillable").val();

                       var thursdayBillable =$("#thursdayBillable").val();

                       var fridayBillable =$("#fridayBillable").val();

                       var saturdayBillable = $("#saturdayBillable").val();

                       var sunBillableVal = $("#sundayBillable").val();
                       var sum=Number(mondayBillable)+Number(tuesdayBillable)+Number(wednesdayBillable)+
                               Number(thursdayBillable)+Number(fridayBillable)+Number(saturdayBillable)+
                               Number(sunBillableVal);
                       $("#sumBillable").html(sum);

    });
         $("#nonbillable").change(function () {

                       var mondayNonBillable=$("#mondayNonBillable").val();

                       var tuesdayNonBillable = $("#tuesdayNonBillable").val();

                       var wednesdayNonBillable =$("#wednesdayNonBillable").val();

                       var thursdayNonBillable =$("#thursdayNonBillable").val();

                       var fridayNonBillable =$("#fridayNonBillable").val();

                       var saturdayNonBillable = $("#saturdayNonBillable").val();

                       var sunNonBillableVal = $("#sundayNonBillable").val();
                       var sum=Number(mondayNonBillable)+Number(tuesdayNonBillable)+Number(wednesdayNonBillable)+
                               Number(thursdayNonBillable)+Number(fridayNonBillable)+Number(saturdayNonBillable)+
                               Number(sunNonBillableVal);
                       $("#sumNonBillable").html(sum);

    });

    });
</script>
@section('pageSpecificScripts')
@endsection
