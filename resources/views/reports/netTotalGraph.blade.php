<?php $i=0; ?>
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
                 @foreach($projectsTimelines as $projectTimelines)
                        {
                          <?php $i++; ?>
                          label: "@if(count($projectTimelines)>0) {{$projectTimelines[0]->project->name}}  @endif",
                          data:  [
                                @foreach($startAndEndDateTimelines as $startAndEndDateTimeline)
                                @foreach ($projectTimelines as $projectTimeline)
                                  @if($startAndEndDateTimeline->monthName==$projectTimeline->monthName)
                                    {
                      
                                         x: "{{$projectTimeline->monthName}}",
                                         y: "@if(count($projectTimelines)>0) {{$projectTimelines[0]->project->budget}}  @endif",

                                   },
                                   @endif
                                   @endforeach
                                   @endforeach
                                   ],
                          fill: false,
                          backgroundColor: "#991d31",
                          borderColor: "#991d31",
                          pointHitRadius: 20,
                        },
                         
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
                        text: 'Projects Total Revenue'
                    }
                }
            });
        

        
        function getChartMonthLabel() {

            return [0,
                @foreach ($startAndEndDateTimelines as $startAndEndDateTimeline)
                    "{{$startAndEndDateTimeline->monthName}}",
                @endforeach
            ];
        }
         function getTotalRevenue()
         {

           return [0, @foreach($startAndEndDateTimelines as $startAndEndDateTimeline )
                     
                      
                                           "{{$startAndEndDateTimeline->revenue}}",
                                 
                    
                      @endforeach
              
                      
                     
                ];

         }
        
    
    </script>
