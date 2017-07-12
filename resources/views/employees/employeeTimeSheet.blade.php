@extends('layouts.app')

@section('content')

    <main>
    <div class="container">
        <div class="row">
            <form class="table table-striped task-table" action="{{ url('employeetimesheet') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}
            <div class="col-sm-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>
                            TimesSheet

                        </h3>
                        <input type="week" name="timesheetDate" id="timesheetDate" class="">Select Date
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
                        <tbody >
                        <tr>
                            <th scope="row">Billable</th>
                            <td class="form-control">M<input id="mondayBillable" name="mondayBillable" class="form-control input-sm "
                                        type="number"></td>

                            <td>tue<input id="tuesdayBillable" name="tuesdayBillable" class="form-control input-sm "
                                          type="number"></td>
                            <td>Wed<input id="wedBillable" name="wedBillable" class="form-control input-sm "
                                          type="number"></td>
                            <td>thr<input id="thursdayBillable" name="thursdayBillable" class="form-control input-sm "
                                          type="number"></td>
                            <td>friday<input id="fridayBillable" name="fridayBillable" class="form-control input-sm "
                                             type="number"></td>
                            <td>sat<input id="saturdayBillable" name="saturdayBillable" class="form-control input-sm "
                                          type="number"></td>
                            <td>sun<input id="sundayBillable" name="sundayBillable" class="form-control input-sm "
                                          type="number"></td>
                        </tr>
                        <tr>
                            <th scope="row">Non Billable</th>
                            <td>mondayNonBillable<input id="mondayNonBillable" name="mondayNonBillable"
                                                        class="form-control input-sm " type="number"></td>

                            <td>tuesdayNonBillable<input id="tuesdayNonBillable" name="tuesdayNonBillable"
                                                         class="form-control input-sm " type="number"></td>
                            <td>wedNonBillable<input id="wedNonBillable" name="wedNonBillable"
                                                     class="form-control input-sm " type="number"></td>
                            <td>thursdayNonBillable<input id="thursdayNonBillable" name="thursdayNonBillable"
                                                          class="form-control input-sm " type="number"></td>

                            <td>fridayNonBillable<input id="fridayNonBillable" name="fridayNonBillable"
                                                        class="form-control input-sm " type="number"></td>

                            <td>saturdayNonBillable<input id="saturdayNonBillable" name="saturdayNonBillable"
                                                          class="form-control input-sm " type="number"></td>
                            <td>sundayNonBillable<input id="sundayNonBillable" name="sundayNonBillable"
                                                        class="form-control input-sm " type="number"></td>

                        </tr>
                        {{--<tr>--}}
                            {{--<th scope="row">Wed<input type="date" name="wednesdayDate" id="wednesdayDate"--}}
                                                      {{--class="form-control input-sm"></th>--}}



                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th scope="row">Thur<input type="date" name="thursdayDate" id="thursdayDate"--}}
                                                       {{--class="form-control input-sm"></th>--}}






                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th scope="row">Fri<input type="date" name="fridayDate" id="fridayDate"--}}
                                                      {{--class="form-control input-sm"></th>--}}


                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th scope="row">Sat<input type="date" name="saturdayDate" id="saturdayDate"--}}
                                                      {{--class="form-control input-sm"></th>--}}


                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th scope="row">Sun<input type="date" name="sundayDate" id="sundayDate"--}}
                                                      {{--class="form-control input-sm"></th>--}}


                        {{--</tr>--}}

                        </tbody>
                    </table>
                    {{--<table class="table table-bordered" >--}}

                    {{--<thead>--}}

                    {{--<tr>--}}
                    {{--<th>Billable <input type="date" name="date" id="date" class="input-sm content-cell"></th>--}}
                    {{--<th>Non Bilable<input type="date" name="date" id="date" class="input-sm"></th>--}}
                    {{--<th>Wed<input type="date" name="date" id="date" class="input-sm"></th>--}}
                    {{--<th>Thu<input type="date" name="date" id="date" class="input-sm"></th>--}}
                    {{--<th>Fri<input type="date" name="date" id="date" class="input-sm"></th>--}}
                    {{--<th>Sat<input type="date" name="date" id="date" class="input-sm"></th>--}}
                    {{--<th>Sun<input type="date" name="date" id="date" class="input-sm"></th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}

                    {{--<td><input id="monday" name="monday" class="form-control input-sm " type="number" />  </td>--}}
                    {{--<td><input id="tuesday" name="tuesday"  class="form-control input-sm " type="number" />  </td>--}}
                    {{--<td><input id="wednesday" name="wednesday"  class="form-control input-sm " type="number" /> </td>--}}
                    {{--<td><input id="thursday" name="thursday"  class="form-control input-sm " type="number" />  </td>--}}
                    {{--<td><input id="friday" name="friday"  class="form-control input-sm " type="number" />  </td>--}}
                    {{--<td><input id="saturday" name="saturday"  class="form-control input-sm " type="number" />  </td>--}}
                    {{--<td><input id="sunday" name="sunday"  class="form-control input-sm " type="number" />  </td>--}}

                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td><input class="form-control input-sm " type="number">  </input></td>--}}
                    {{--<td><input class="form-control input-sm " type="number">  </input></td>--}}
                    {{--<td><input class="form-control input-sm " type="number">  </input></td>--}}
                    {{--<td><input class="form-control input-sm " type="number">  </input></td>--}}
                    {{--<td><input class="form-control input-sm " type="number">  </input></td>--}}
                    {{--<td><input class="form-control input-sm " type="number">  </input></td>--}}
                    {{--</tr>--}}


                    {{--</tbody>--}}

                    {{--</table>--}}
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
        $(document).ready(function(){
            $("#timesheetDate").change(function(){
                timesheetDate= $("#timesheetDate").val();
                var monDiv='Mon ('+ $("#timesheetDate").val() + ')';
                $("#monDiv").html(monDiv);

                var tueDiv='Tue ('+ $("#timesheetDate").val() + ')';
                $("#tueDiv").html(tueDiv);
                var wedDiv='Wed ('+ $("#timesheetDate").val() + ')';
                $("#wedDiv").html(wedDiv);
                var thurDiv='Thur ('+ $("#timesheetDate").val() + ')';
                $("#thurDiv").html(thurDiv);
                var friDiv='Friday ('+ $("#timesheetDate").val() + ')';
                $("#friDiv").html(friDiv); var mon='Mon ('+ $("#timesheetDate").val() + ')';
                var satDiv='sat ('+ $("#timesheetDate").val() + ')';
                $("#satDiv").html(satDiv); var mon='Mon ('+ $("#timesheetDate").val() + ')';
                var sunDiv='sun ('+ $("#timesheetDate").val() + ')';
                $("#sunDiv").html(sunDiv); var mon='Mon ('+ $("#timesheetDate").val() + ')';



            });
        });
    </script>
@endsection
