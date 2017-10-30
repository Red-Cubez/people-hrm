<html>
<head>
<style>

th, td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
    
}

tr:nth-child(even){background-color: #f2f2f2}

</style>
</head>
<body>

<div class="container">

@if (count($projectsTimelines) > 0)
               

        <h3>Projects Report</h3>
     
         
            <table style="border-collapse: collapse;" >
              
                <thead>
                 <tr>  
                      <th rowspan="2">#</th> 
                      <th rowspan="2">Project Name </th>  

                      <th rowspan="2">Month Name</th>
                      <th rowspan="2">Project Cost</th> 
                      <th colspan="2" style="text-align: center;"> Resources Details</th>
                        
                  
                </tr>
                <tr style="background-color:#ffffff">
                      
                      <th style="text-align: center;">Resource Name</th>
                      <th style="text-align: center;">Resource Cost</th>
                 
                </tr>
                
                </thead>
            
                <tbody>
         
                    @foreach ($projectsTimelines as $key=>$projectMonthlyTimelines )

                        <?php 
                        $counter=0;
                        ?>
                        @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                            <tr>
                                <td>@if($counter==0){{++$key}}@endif</td>
                                <td>@if($counter==0){{$projectMonthlyTimelines[0]->projectName}}@endif</td>
                                @if($counter>0)
                                <td>{{$projectMonthlyTimeline->monthName}}</td>
                                <td>{{$projectMonthlyTimeline->totalCost}}</td>
                                    <td>
                                      @if(count($projectMonthlyTimeline->resourcesMonthlyDetails))
                                        @for($count=0; $count<=count($projectMonthlyTimeline->resourcesMonthlyDetails);$count++)
                                     
                                               
                                        @endfor     

                                              @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $resourceDetail)

                                                 <table>
                                                  
                                                <tr>
                                               
                                                  <td style="border: none;">{{$resourceDetail->resourceName}}</td>   
                                                                                                
                                                </tr> 
                                                  </table> 
                                                  
                                                @endforeach  
                                                                                
                                       @endif  
                                    </td>   
                                    <td>
                                      @if(count($projectMonthlyTimeline->resourcesMonthlyDetails))
                                             
                                       @for($count=0; $count<=count($projectMonthlyTimeline->resourcesMonthlyDetails);$count++)
                                           
                                               
                                        @endfor
                                             
                                              @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $resourceDetail)
                                               <table >
                                              <tr >
                                                                                                
                                                 <td style="border: none;">{{$resourceDetail->resourceCost}}</td>

                                                
                                              </tr> 
                                             </table> 
                                              @endforeach  
                                                                                   
                                     @endif  
                                  </td>
                                @else 
                                <td>
                                </td>  
                                <td>
                                </td>  
                                <td>
                                </td>  
                                <td>
                                </td>  
                                @endif
                               

                            </tr>
                           
                            <?php 
                            $counter++;
                            ?>        
                                            
                        @endforeach
                    
                    @endforeach

                
                </tbody>
            </table>
        </div>
    </article>


@endif
</body>


