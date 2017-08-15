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
                     <td id="sumBillable">
                    </td>
                </tr>
                <tr id="nonbillable">
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
                     <td id="sumNonBillable">
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
        calculateBillableSum();
        calculateNonBillableSum();

         $("#billable").change(function () {

                    calculateBillableSum();

    });
         $("#nonbillable").change(function () {
            calculateNonBillableSum();

    });

    });
    function calculateBillableSum()
    {
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
    }
     function calculateNonBillableSum()
    {
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
    }
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