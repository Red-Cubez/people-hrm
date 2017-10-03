<?php $i=0; ?>
 <div class="panel panel-default">
        <div class="panel-body">
            <div style="width: 600px; height: 400px;display: block;">
                <canvas id="internalProjectsChartWithProfit"></canvas>
            </div>
        </div>
    </div>

 <script type="text/javascript">
        
            data = {
                datasets: [
                 @foreach($internalProjectsmonthlyTimelines as $monthlyTimeline)
                  @if($i>0)
                        {
                          <?php $i++; ?>
                          label: "@if(count($monthlyTimeline)>0) {{$monthlyTimeline[0]->projectName}}  @endif",
                          data:  [ 
                                @foreach($monthlyTimeline as $monthlyTimelineItem)
                                 @if($monthlyTimelineItem->isActive)
                                
           
                                    {
                      
                                         x: "{{$monthlyTimelineItem->monthName}}",
                                         y: "{{$monthlyTimelineItem->totalProfit}}",

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
                          label: "Monthly Profit",
                          data:  getMonthlyProfit(),
                          fill: false,
                          backgroundColor: "blue",
                          borderColor: "blue",
                          pointHitRadius: 20,  
                        },

                          ],
               
                labels: getChartMonthLabel()
                    };


            var ctx = document.getElementById("internalProjectsChartWithProfit");
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
                                labelString: 'Rupees'
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Projects Monthly Profit'
                    }
                }
            });
        

        
        function getChartMonthLabel() {

            return [
                @foreach ($internalProjectsmonthlyTimelines[0] as $monthlyTimeline)

                    "{{$monthlyTimeline->monthName}}",
                @endforeach
            ];
        
        }
         function getMonthlyProfit()
         {

               return [ @foreach($internalProjectsmonthlyTimelines[0] as $monthlyTimeline )
                     
                      {
                                           
                                         x: "{{$monthlyTimeline->monthName}}",

                                         y: "{{$monthlyTimeline->totalProfit}}",
                                 
                    },
                      @endforeach
              
                      
                     
                ];




         }
        
    
    </script>
