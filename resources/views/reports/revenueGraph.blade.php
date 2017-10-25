<?php $i=0; ?>
{{-- @if(count($monthlyTimelines)>1) --}}

 <div class="panel panel-default">
        <div class="panel-body">
            <div style="width: 600px; height: 400px;display: block;">
                <canvas id="myChartWithTotalRevenue"></canvas>
            </div>
        </div>
    </div>

 <script type="text/javascript">
        
            data = {
                datasets: [
                  @foreach($monthlyTimelines as $monthlyTimeline)
                  @if($i>0)
                        {
                          <?php $i++; ?>
                          label: "@if(count($monthlyTimeline)>0) {{$monthlyTimeline[0]->projectName}}  @endif",
                          data:  [
                                @foreach($monthlyTimeline as $monthlyTimelineItem)
                                 @if($monthlyTimelineItem->isActive)
                                
                                    {
                      
                                         x: "{{$monthlyTimelineItem->monthName}}",
                                         y: "{{$monthlyTimelineItem->totalRevenue}}",

                                   },
                                @else
                                              {                    
                                                 x: null,

                                                 y: null,

                                            },
                                           @endif 
                                   @endforeach
                                   ],
                          fill: false,
                             backgroundColor: "{{$monthlyTimeline[0]->color}}"  ,
                                 borderColor: " {{$monthlyTimeline[0]->color}} ",
                                 pointHoverBackgroundColor:"{{$monthlyTimeline[0]->color}}" ,
                                 pointHoverBorderColor: "{{$monthlyTimeline[0]->color}}",         
                                 pointHitRadius: 20,
                        },
                    @endif
                         <?php $i++; ?>
                @endforeach
                    {
                          label: "Total Revenue",
                          data:  getTotalRevenue(),
                          fill: false,
                          backgroundColor: "gray",
                          borderColor: "gray",
                          pointHitRadius: 20,  
                        },

                          ],
               
                labels: getChartMonthLabel()
                    };


            var ctx = document.getElementById("myChartWithTotalRevenue");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom'
                    },
                     tooltips: {
                         enabled: true,
                        mode: 'index',
                        intersect:false,
                      },
                    hover: {
                        
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Months'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '@if(isset($currencyNameAndSymbol)){{$currencyNameAndSymbol}}@endif'
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Projects Total Revenue'
                    }
                }
            });
        

        
        function getChartMonthLabel() {

             return [
                @foreach ($monthlyTimelines[0] as $monthlyTimeline)

                    "{{$monthlyTimeline->monthName}}",
                @endforeach
            ];
        }
         function getTotalRevenue()
         {

            return [ @foreach($monthlyTimelines[0] as $monthlyTimeline )
                     
                      {
                                           
                                         x: "{{$monthlyTimeline->monthName}}",

                                         y: "{{$monthlyTimeline->totalRevenue}}",
                                 
                    },
                      @endforeach
              
                      
                     
                ];
         }
        
    
    </script>
{{-- @else
No Record Found    
@endif --}}