<style type="text/css">
  table td, table th{
    border:1px solid black;
  }
</style>

<div class="container">

@if (count($projectsTimelines) > 0)
                    <?php
                    $data=serialize($projectsTimelines); 
                    
                    ?>
   <div class="col-md-2">
          <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
             {{ csrf_field() }}
            <input type="hidden" name="projectsTimelines" value="{{$data}}">
            <button class="btn btn-success" type="submit">Export</button>
          </form>

    </div>      
        <h3>Projects Report</h3>
     
         
            <table >
              
                <thead>
               <tr>   
                <th>Project Name </th>  

                <th>Month Name</th>
                <th>Project Cost</th>
                <th>Resources Cost</th>
                
                </thead>
              </tr>
                <tbody>
         
                @foreach ($projectsTimelines as $key=>$projectMonthlyTimelines )
                    
                           <tr>
                              
                              <td>{{++$key.' . '. $projectMonthlyTimelines[0]->projectName }}
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
             
                    
                
                @endforeach

                
                </tbody>
            </table>
        </div>
    </article>


@endif
