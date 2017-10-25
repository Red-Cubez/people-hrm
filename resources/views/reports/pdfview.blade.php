<style type="text/css">
  table td, table th{
    border:1px solid black;
  }
</style>

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
     
         
            <table >
              
                <thead>
               <tr>   
                <th>Project Name </th>  

                <th>Month Name</th>
                <th>Project Cost</th>
                <th>Resources Details</th>
                
                </thead>
              </tr>
                <tbody>
         
                @foreach ($projectsTimelines as $key=>$projectMonthlyTimelines )
                    <?php 
                    $counter=0;
                    ?>
                   @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
                        <tr>

                            <td>@if($counter==0){{$projectMonthlyTimelines[0]->projectName}}@endif</td>
                            <td>{{$projectMonthlyTimeline->monthName}}</td>
                            <td>{{$projectMonthlyTimeline->totalCost}}</td>
                            <td>
                              @if(count($projectMonthlyTimeline->resourcesMonthlyDetails))
                                  
                                       <table>
                                        <tr>
                                        <th>
                                          Resource Name
                                        </th>
                                          <th>
                                          Resource Cost
                                        </th>
                                      </tr>
                                        @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $resourceDetail)
                                        <tr>

                                          <td>{{$resourceDetail->resourceName}}</td>   
                                           <td>{{$resourceDetail->resourceCost}}</td>   
                                          
                                        </tr> 
                                      
                                        @endforeach  
                                       </table> 
                                   
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
