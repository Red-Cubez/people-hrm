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
               
   {{-- <div class="col-md-2">
          <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
             {{ csrf_field() }}
            <input type="hidden" name="projectsTimelines" value="{{$data}}">
            <button class="btn btn-success" type="submit">Export</button>
          </form>

    </div>       --}} 
        <h3>Projects Report</h3>
     
         
            <table style="" >
              
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

                                <td>{{$projectMonthlyTimeline->monthName}}</td>
                                <td>{{$projectMonthlyTimeline->totalCost}}</td>
                                <td>
                                  @if(count($projectMonthlyTimeline->resourcesMonthlyDetails))
                        
                                          @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $resourceDetail)

                                             <table>
                                              
                                            <tr>
                                           
                                              <td>{{$resourceDetail->resourceName}}</td>   
                                                                                            
                                            </tr> 
                                              </table> 
                                              
                                            @endforeach  
                                                                            
                                   @endif  
                                </td>   
                                <td>
                                  @if(count($projectMonthlyTimeline->resourcesMonthlyDetails))
                                                                                                               
                                            @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $resourceDetail)
                                             <table>
                                            <tr>
                                                                                              
                                               <td>{{$resourceDetail->resourceCost}}</td>

                                              
                                            </tr> 
                                           </table> 
                                            @endforeach  
                                                                                 
                                   @endif  
                                </td>   
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


