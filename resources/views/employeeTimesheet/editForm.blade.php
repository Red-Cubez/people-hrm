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
                        <input class="form-control input-sm " id="mondayBillable" min="0" name="mondayBillable" required="" type="number"  @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['monday']}}" @endif/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="tuesdayBillable" min="0" name="tuesdayBillable" required="" type="number"  @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['tuesday']}}" @endif/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="wednesdayBillable" min="0" name="wednesdayBillable" required="" type="number"  @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['wednesday']}}" @endif/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="thursdayBillable" min="0" name="thursdayBillable" required="" type="number"  @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['thursday']}}" @endif/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="fridayBillable" min="0" name="fridayBillable" required="" type="number"  @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['friday']}}" @endif/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="saturdayBillable" min="0" name="saturdayBillable" type="number"  @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['saturday']}}" @endif />
                    </td>
                    <td>
                        <input class="form-control input-sm " id="sundayBillable" min="0" name="sundayBillable" type="number"
                         @if(isset($timesheet)) value="{{$billableWeeklyTimesheet['sunday']}}" @endif />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Non Billable
                    </th>
                    <td>
                        <input class="form-control input-sm " id="mondayNonBillable" min="0" name="mondayNonBillable" type="number"  @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['monday']}}" @endif/>
                    </td>
                    <td>
                        <input class="form-control input-sm " id="tuesdayNonBillable" min="0" name="tuesdayNonBillable" type="number" @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['tuesday']}}" @endif />
                    </td>
                    <td>
                        <input class="form-control input-sm " id="wednesdayNonBillable" min="0" name="wednesdayNonBillable" type="number" @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['wednesday']}}" @endif />
                    </td>
                    <td>
                        <input class="form-control input-sm " id="thursdayNonBillable" min="0" name="thursdayNonBillable" type="number" @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['thursday']}}" @endif />
                    </td>
                    <td>
                        <input class="form-control input-sm " id="fridayNonBillable" min="0" name="fridayNonBillable" type="number" @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['friday']}}" @endif />
                    </td>
                    <td>
                        <input class="form-control input-sm " id="saturdayNonBillable" min="0" name="saturdayNonBillable" type="number" @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['saturday']}}" @endif />
                    </td>
                    <td>
                        <input class="form-control input-sm " id="sundayNonBillable" min="0" name="sundayNonBillable" type="number" @if(isset($timesheet)) value="{{$nonBillableWeeklyTimesheet['sunday']}}" @endif />
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-trash">
                Update TimeSheet
            </i>
        </button>

    {{--
        <a href="/employeetimesheet/store">
            --}}
    {{--
            <button class="btn btn-primary">
                Add Timesheet--}}

    {{--
            </button>
            --}}
    {{--
        </a>
        --}}
    </input>
</div>
<script type="text/javascript">
    $(document).ready(function () {
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
    });
</script>
@section('pageSpecificScripts')
@endsection











{{-- @extends('layouts.app')

@section('content')
<main>
    <div class="container">
        @if($timesheet->isApproved==0)
        <div class="row">
                <div class="col-sm-12">
                    <form class="table table-striped task-table" action="{{ url('employeetimesheet/'.$timesheet->id) }}" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        @include('employeeTimesheet.create')
                    </form>
                </div>
            </input>
        </div>
        @elseif($timesheet->isApproved==1)
        <div class="row">
            <div class="col-sm-12">
                @include('employeeTimesheet.showEmployeeTimesheets')
            </div>
        </div>
        @endif
    </div>
</main>
@endsection
 --}}