@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                    All UnApproved Timesheets
                </h3>
            </div>
            <div class="panel-body">


             @if(count($employeesTimesheets)>0)
                 <form class="" action="{{ url('/employeetimesheets/approve/') }}" method="POST">
                        {{ csrf_field() }}
                      
 
                     <table class="table table-striped task-table">
              
                     <thead>
                        <th>
                           Employee Name
                        </th>
                        <th>
                            Year And Week No
                        </th>
                        <th>
                            Week Start Date
                        </th>
                        <th>
                            Week End Date
                        </th>
                         <th>
                            Billabale Hours
                        </th>
                        <th>
                            Non Billabale Hours
                        </th>
                         <th>
                            Approve
                        </th>
                        <th>
                            Operations
                        </th>
                     </thead>
                    
                     <tbody>
                            @foreach($employeesTimesheets as $timesheet)
                                 <tr>
                                 <td class="table-text">
                                   <div>
                                     <a href="/employees/{{$timesheet->employeeId}}" >
                                        {{$timesheet->employeeName}}
                                  </a>
                                   </div>
                                 </td>
                                 <td class="table-text">
                                   <div>
                                    
                                        {{$timesheet->weekNoAndYear}}
                                    
                                   </div>
                                 </td>
                                 <td class="table-text">
                                     <div>
                                         {{$timesheet->weekStartDate}}
                                     </div>
                                 </td>
                                 <td class="table-text">
                                    <div>
                                         {{$timesheet->weekEndDate}}
                                    </div>
                                 </td>
                                 <td class="table-text">
                                    <div>
                                        12
                                    </div>
                                 </td>
                                 <td class="table-text">
                                    <div>
                                        12
                                    </div>
                                 </td>
                                 <td class="table-text">
                                    <div>
                                    <input type="checkbox" name="areApproved[]" value="{{$timesheet->id}}" />
                                    </div>
                                 </td>
                               
                                <td>
                                
                                <a href="/employeetimesheet/{{$timesheet->id}}/edit">
                        
                                    <button type="button" class="btn btn-primary"> View </button>
                                </a>
                               
                                <a href="/employeetimesheet/{{$timesheet->id}}/edit">
                                    <button type="button" class="btn btn-primary"> Edit </button>
                                </a>

                              </td>
                              </tr>
                            @endforeach
                                     
                    </tbody>

                </table>
               
         <button type="submit" > Submit </button>
         </form>
            @else
            No Record Found
            @endif

            </div>
        </div>
    </div>
</div>
@endsection
