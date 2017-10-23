<style type="text/css">
  table td, table th{
    border:1px solid black;
  }
</style>

<div class="container">
<?php $counter=0; ?>
@if (count($monthlyTimelines) > 0)
   
        <h3>Projects Report</h3>
     
         
            <table  >
              
                <thead>
               <tr>   
                <th>Project Name </th>  

                <th>Month Name</th>
                <th>Project Cost</th>
                <th>Resources Cost</th>
                
                </thead>
              </tr>
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
                                            
                                          @if(count($projectMonthlyTimeline->resourcesMonthlyDetails)>0) 

                                                @foreach ($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourcesMonthlyDetail)
                                            <br/>
                                                @endforeach
                                             <br/>    
                                           @endif   
                                      <hr/>        
                                    @endif         
                               @endforeach
                              </td>
                               <td>  
                               @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                                    @if($projectMonthlyTimeline->isActive)
                                          
                                           {{ $projectMonthlyTimeline->totalCost }}
                                            
                                           @if(count($projectMonthlyTimeline->resourcesMonthlyDetails)>0) 

                                                @foreach ($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourcesMonthlyDetail)
                                           <br/>
                                                @endforeach
                                             <br/>    
                                           @endif   
                                        <hr/>    
                                    @endif         
                               @endforeach
                              </td>
                              <td>
                                @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                                    @if($projectMonthlyTimeline->isActive)
                                     
                                            @if(count($projectMonthlyTimeline->resourcesMonthlyDetails)>0) 

                                                @foreach ($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourcesMonthlyDetail)
                                            
                                                  {{++$key.'.'.$resourcesMonthlyDetail->resourceName .'(Cost:'.$resourcesMonthlyDetail->resourceCost.')'}} 

                                                 <br/>     
                                                @endforeach
                                           
                                            @endif   
                                            <br/> 
                                        
                                      <hr/>
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
