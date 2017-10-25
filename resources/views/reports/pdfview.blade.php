<html>
<head>

<link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css">
<style>



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
                        <th>#</th> 
                        <th>Project</th>  
                        <th>Month</th>
                        <th>Project Cost</th> 
                        <th style=""> 
                          <table>
                    
                               <tr> 
                               <th colspan="2" > Resources Details</th>
                               </tr>
                               <tr style="background-color: #ffffff">
                                <th >Name</th>
                                <th>Cost</th>
                                </tr>
                         </table>
                            </tr>
                        </th>
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
                                  @if(count($projectMonthlyTimeline->resourcesMonthlyDetails) > 0)
                                         <table>
                                          <tr></tr>

                                        </table>
                                          @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourceDetail)

                                             <table>

                                            <tr style="background: #ffffff;" >
                                               <td>{{++$key.' . '.$resourceDetail->resourceName}}</td>  
                                               <td>{{++$key.' . '.$resourceDetail->resourceCost}}</td>                                    
                                            </tr> 
                                              </table>
                                            @endforeach
                                   @endif  
                                </td>   
                               {{--  <td>
                                  @if(count($projectMonthlyTimeline->resourcesMonthlyDetails) > 0)
                                                                                                               
                                            @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $resourceDetail)
                                             <table>
                                            <tr>                                                
                                               <td>{{$resourceDetail->resourceCost}}</td>
                                            </tr> 
                                           </table> 
                                            @endforeach  
                                                                                 
                                   @endif  
                                </td>    --}}
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


