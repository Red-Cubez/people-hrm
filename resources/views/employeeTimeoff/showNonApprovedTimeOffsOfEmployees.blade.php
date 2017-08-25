@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                    All UnApproved Time Offs
                </h3>
            </div>
            <div class="panel-body">


             @if(count($employeesTimeoffs)>0)
                 <form class="" action="{{ url('/employeestimeoffs/approve/') }}" method="POST">
                        {{ csrf_field() }}
                      
 
                     <table class="table table-striped task-table">
              
                     <thead>
                        <th>
                           Employee Name
                        </th>
                        <th>
                            Start Date
                        </th>
                        <th>
                            End Date
                        </th>
                        <th>
                            # Of Days
                        </th>
                         
                         <th>
                            Approve
                        </th>
                        <th>
                            Operations
                        </th>
                     </thead>
                    
                     <tbody>
                            @foreach($employeesTimeoffs as $timeoff)
                                 <tr>
                                 <td class="table-text">
                                   <div>
                                     <a href="/employees/{{$timeoff->employeeId}}" >
                                        {{$timeoff->employeeName}}
                                  </a>
                                   </div>
                                 </td>
                                 <td class="table-text">
                                   <div>
                                    
                                        {{$timeoff->startDate}}
                                    
                                   </div>
                                 </td>
                                 <td class="table-text">
                                     <div>
                                         {{$timeoff->endDate}}
                                     </div>
                                 </td>
                                 <td class="table-text">
                                    <div>
                                         {{$timeoff->totalCount}}
                                    </div>
                                 </td>
                                 
                                 <td class="table-text">
                                    <div>
                                    <input type="checkbox" name="areApproved[]" value="{{$timeoff->timeoffId}}" />
                                    </div>
                                 </td>
                               
                                <td>
                                   
                                <a href="/employeetimeoff/{{$timeoff->timeoffId}}/edit">
                                  <button type="button" class="btn btn-primary">
                                        EDIT
                                  </button>
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
