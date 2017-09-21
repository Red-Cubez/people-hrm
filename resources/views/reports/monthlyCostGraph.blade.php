
<?php $i=0; ?>

 <div class="panel panel-default">
        <div class="panel-body">
            <div style="width: 600px; height: 400px;display: block;">
                <canvas id="myChartWithCost"></canvas>
            </div>
        </div>
    </div>

 <script type="text/javascript">
        $(document).ready(function () {
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
                                         y: "{{$projectTimeline->cost}}",

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
                          label: "Monthly Cost",
                          data:  getMonthlyCost(),
                          fill: false,
                          backgroundColor: "orange",
                          borderColor: "orange",
                          pointHitRadius: 20,  
                        },

                          ],
               
                labels: getChartMonthLabel()
                    };


            var ctx = document.getElementById("myChartWithCost");
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
                        text: 'Projects Monthly Cost'
                    }
                }
            });
        });

        
        function getChartMonthLabel() {

            return [0,
                @foreach ($startAndEndDateTimelines as $startAndEndDateTimeline)
                    "{{$startAndEndDateTimeline->monthName}}",
                @endforeach
            ];
        }
         function getMonthlyCost()
         {

           return [0, @foreach($startAndEndDateTimelines as $startAndEndDateTimeline )
                     
                      
                                           "{{$startAndEndDateTimeline->cost}}",
                                 
                    
                      @endforeach
              
                      
                     
                ];

         }
        
    
    </script>
