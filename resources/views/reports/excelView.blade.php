<html>
<head>

{{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}" type="text/css"> --}}
<style>
</style>
</head>
<body>

<div class="container">

@if (count($projectsTimelines) > 0)
    
        <h3>Projects Report</h3>
            <table style="" >
                <thead>
                   <tr>  
        
                        <th>Project</th>  
                        <th>Month</th>
                        <th>Project Cost</th> 
                        <th style=""> 
                          <table>
                    
                               <tr> 
                               <th colspan="2" > Resources Details</th>
                               </tr>
                               <tr >
                                <th >Name</th>
                                <th >Cost</th>
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
                         <tr>
                                <td >
                                {{$projectMonthlyTimelines[0]->projectName}}
                                </td>
                                              <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                         </tr> 
                        @foreach ($projectMonthlyTimelines as $projectMonthlyTimeline)
 
                                <tr>
                                    <td>
                                    </td>
                                    <td>{{$projectMonthlyTimeline->monthName}}</td>
                                    <td>{{$projectMonthlyTimeline->totalCost}}</td>
                                </tr>
             
                                
                                @if(count($projectMonthlyTimeline->resourcesMonthlyDetails) > 0)

                                                                             
                                        @foreach($projectMonthlyTimeline->resourcesMonthlyDetails as $key=>$resourceDetail)
       
                                           <tr>
                                               <td>
                                               </td>
                                               <td>
                                               </td>
                                               <td>
                                               </td>
                                               <td >{{$resourceDetail->resourceName}}</td>  
                                            
                                               <td >{{$resourceDetail->resourceCost}}</td>  
                                            </tr>
                                  
                                        @endforeach
                                 
                               
                                @endif              

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


