@extends('layouts.app')
@section('content')
<section class="showNonAppSetion">
    <div class="container">
    <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>All UnApproved Timesheets</h3>
            </div>
            <div class="panel-body">
            @if(count($employeesTimesheets)>0)
            <form class="" action="{{ url('/employeestimesheets/approve/') }}" method="POST">
                        {{ csrf_field() }}
                         <div class="scroll-panel-table table-responsive">
                      <table class="table table-bordered table-hover table-striped">
                      <thead>
                      <tr>
                        <th>Employee Name</th>
                        <th>Year And Week No</th>
                        <th>Week Start Date</th>
                        <th>Week End Date</th>
                         <th>Billabale Hours</th>
                        <th> Non Billabale Hours</th>
                         <th>Approve</th>
                        <th></th>
                        </tr>
                     </thead>
                      <tbody>
                            @foreach($employeesTimesheets as $timesheet)
                                 <tr>
                                 <td>
                                   <a href="/employees/{{$timesheet->employeeId}}" >
                                        {{$timesheet->employeeName}}
                                  </a>
                                 </td>
                                 <td > {{$timesheet->weekNoAndYear}}</td>
                                 <td > {{$timesheet->weekStartDate}} </td>
                                 <td > {{$timesheet->weekEndDate}} </td>
                                 <td > {{$timesheet->billableWeeklyHours}}  </td>
                                 <td >  {{$timesheet->nonBillableWeeklyHours}}  </td>
                                 <td >   
                                <input type="checkbox" name="areApproved[]" value="{{$timesheet->id}}" />
                                 </td>
                                  <td>
                                 <a href="/employeetimesheet/{{$timesheet->id}}">
                        
                                    <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                </a>
                               
                                <a href="/employeetimesheet/{{$timesheet->id}}/edit">
                                   <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>

                              </td>
                              </tr>
                            @endforeach
                                     
                    </tbody>

                </table>
                 <button type="submit" class="button button40 pull-right" > Submit </button>
               </div>
        
         </form>
            @else
            No Record Found
            @endif

            </div>
        </div>
    </div>
</div> 
 </div>
</section>
@endsection
