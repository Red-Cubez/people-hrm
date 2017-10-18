@extends('layouts.app')

@section('content')
<?php $counter=0; ?>
@if (count($monthlyTimelines) > 0)
    <article class="show-role">
        <h3>Project Reports</h3>
        <div class="table-responsive">
          {{-- table-striped table-bordered table-hover table-condensed --}}
            <table class="table table-condensed  table-bordered table-striped table-hover ">
                <thead>
                <th>Project Name </th>  
                <th>Month Name</th>
                <th>Project Cost</th>
                <th>Resources Cost</th>
                
                </thead>
                <tbody>

                @foreach ($monthlyTimelines as $key=>$projectMonthlyTimelines )
                    @if (count($monthlyTimelines)>1)
                @if($counter>0 )
                           <tr>
                              <td>{{$key++.' . '. $projectMonthlyTimelines[0]->projectName }}
                              </td>
                              
                               <td>  
                               @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                              
                                    @if($projectMonthlyTimeline->isActive)
                                     
                                           {{ $projectMonthlyTimeline->monthName }}
                                              <br />
                                          @if(count($projectMonthlyTimeline->resourcesMonthlyDetails)>0) 

                                                @foreach ($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourcesMonthlyDetail)
                                            </br>
                                                @endforeach
                                           @endif   
                                         <hr>      
                                    @endif         
                               @endforeach
                              </td>
                               <td>  
                               @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                                    @if($projectMonthlyTimeline->isActive)
                                      
                                           {{ $projectMonthlyTimeline->totalCost }}
                                              <br />
                                           @if(count($projectMonthlyTimeline->resourcesMonthlyDetails)>0) 

                                                @foreach ($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourcesMonthlyDetail)
                                            </br>
                                                @endforeach
                                           @endif   
                                        <hr>      
                                    @endif         
                               @endforeach
                              </td>
                              <td>
                                @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                                    @if($projectMonthlyTimeline->isActive)
                               				 
                                            @if(count($projectMonthlyTimeline->resourcesMonthlyDetails)>0) 

                                                @foreach ($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourcesMonthlyDetail)
                                    				
                                                  {{++$key.'.'.$resourcesMonthlyDetail->resourceName .'____Cost:'.$resourcesMonthlyDetail->resourceCost}} </br> 
                                     
                                            
                                                @endforeach
                                           
                                            @endif   </br> 
                                        
                                      <hr>
                                    @endif   
                                @endforeach        
                              </td>
                       
                           </tr>
                        @endif 
                    @endif
                  <?php $counter++; ?>        
                @endforeach
                
                </tbody>
            </table>
        </div>
    </article>


@endif

@endsection
