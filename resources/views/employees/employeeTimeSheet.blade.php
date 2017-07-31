@extends('layouts.app')

@section('content')

    <main>
        <div class="container">
            <div class="row">
                <form class="table table-striped task-table" action="{{ url('employeetimesheet') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" name="employeeId" id="employeeId" value="{{$employeeId}}">
                    <div class="col-sm-12">

                        <div class="panel panel-default">
                            <div id="timeSheetDateDiv" class="panel-heading">
                                <h3>
                                    TimesSheet

                                </h3>
                                <input type="week" name="timesheetDate" id="timesheetDate" class="" required>Select Date
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th id="monDiv">Mon</th>
                                    <th id="tueDiv">Tue</th>
                                    <th id="wedDiv">Wed</th>
                                    <th id="thurDiv">Thur</th>
                                    <th id="friDiv">Friday</th>
                                    <th id="satDiv">Sat</th>
                                    <th id="sunDiv">Sun</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Billable</th>
                                    <td class="form-control">Mon<input id="mondayBillable" name="mondayBillable"
                                                                     class="form-control input-sm "
                                                                     type="number" min="0" required></td>

                                    <td>tue<input id="tuesdayBillable" name="tuesdayBillable"
                                                  class="form-control input-sm "
                                                  type="number" min="0" required></td>
                                    <td>Wed<input id="wedBillable" name="wedBillable" class="form-control input-sm "
                                                  type="number" min="0" required></td>
                                    <td>thr<input id="thursdayBillable" name="thursdayBillable"
                                                  class="form-control input-sm "
                                                  type="number" min="0" required></td>
                                    <td>friday<input id="fridayBillable" name="fridayBillable"
                                                     class="form-control input-sm "
                                                     type="number" min="0" required></td>
                                    <td>sat<input id="saturdayBillable" name="saturdayBillable"
                                                  class="form-control input-sm "
                                                  type="number" min="0" required></td>
                                    <td>sun<input id="sundayBillable" name="sundayBillable"
                                                  class="form-control input-sm "
                                                  type="number" min="0" required></td>
                                </tr>
                                <tr>
                                    <th scope="row">Non Billable</th>
                                    <td>mondayNonBillable<input id="mondayNonBillable" name="mondayNonBillable"
                                                                class="form-control input-sm " type="number" min="0"></td>

                                    <td>tuesdayNonBillable<input id="tuesdayNonBillable" name="tuesdayNonBillable"
                                                                 class="form-control input-sm " type="number" min="0" required></td>
                                    <td>wedNonBillable<input id="wedNonBillable" name="wedNonBillable"
                                                             class="form-control input-sm " type="number" min="0" required></td>
                                    <td>thursdayNonBillable<input id="thursdayNonBillable" name="thursdayNonBillable"
                                                                  class="form-control input-sm " type="number" min="0" required></td>

                                    <td>fridayNonBillable<input id="fridayNonBillable" name="fridayNonBillable"
                                                                class="form-control input-sm " type="number" min="0" required></td>

                                    <td>saturdayNonBillable<input id="saturdayNonBillable" name="saturdayNonBillable"
                                                                  class="form-control input-sm " type="number" min="0" required></td>
                                    <td>sundayNonBillable<input id="sundayNonBillable" name="sundayNonBillable"
                                                                class="form-control input-sm " type="number" min="0" required></td>
                                </tr>

                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-trash"> Add TimeSheet</i>
                            </button>
                            {{--<a href="/employeetimesheet/store">--}}
                            {{--<button class="btn btn-primary"> Add Timesheet--}}

                            {{--</button>--}}
                            {{--</a>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

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
                        if(data.isAlreadyEntered==true)
                        {
                            $("#alreadyEnteredMessage").remove();
                            html='<div id="alreadyEnteredMessage">You Have already entered timesheet for week '+timesheetDate+'</div>';
                            $("#timeSheetDateDiv").before(html);
                            $("#timesheetDate").val(null);

                        }
                        if(data.isAlreadyEntered==false) {
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
@endsection

@section('pageSpecificScripts')


@endsection
