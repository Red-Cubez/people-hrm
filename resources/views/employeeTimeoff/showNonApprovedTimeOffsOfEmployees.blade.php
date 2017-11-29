@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3>  All UnApproved Time Offs </h3>
            </div>
            <div class="panel-body"> 
            @if(count($employeesTimeoffs)>0)
                 <form class="" action="{{ url('/employeestimeoffs/approve/') }}" method="POST">
                        {{ csrf_field() }}
       <div class="scroll-panel-table table-responsive">
            <table class="table table-bordered table-hover table-striped">
               <thead>
               <tr>
                <th> Employee Name </th>
                <th> Start Date </th>
                 <th> End Date </th>
                 <th> # Of Days</th>
                 <th> Approve</th>
                 <th></th>
                </tr>  
               </thead>
               
                     <tbody>
                            @foreach($employeesTimeoffs as $timeoff)
                                 <tr>
                                 <td >
                                     <a href="/employees/{{$timeoff->employeeId}}" >
                                        {{$timeoff->employeeName}}
                                  </a>
                                 </td>
                                 <td>{{$timeoff->startDate}}  </td>
                                 <td> {{$timeoff->endDate}} </td>
                                 <td> {{$timeoff->totalCount}}</td>
                                  <td>
                                     <input type="checkbox" name="areApproved[]" value="{{$timeoff->timeoffId}}" />
                                   </td> 
                                   <td>
                                    <a href="/employeetimeoff/{{$timeoff->timeoffId}}/edit">
                                  <button type="button" class="button20">
                                   <i class="fa fa-pencil-square-o fa-2x"></i>
                                  </button>
                                </a>

                              </td>
                              </tr>
                            @endforeach
                           </tbody>
                            </table>
               </div>
         <button type="submit" class="button button40 pull-right"> Submit </button>
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
