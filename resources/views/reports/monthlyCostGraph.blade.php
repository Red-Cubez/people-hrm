@if(count($projectsTimelines) > 0)
<?php $sumOfCost = 0; $monthlyCostArray = array(); $i=0; $colors; ?>

 <div class="panel panel-default">
        <div class="panel-body">
            <div style="width: 600px; height: 400px;display: block;">
                <canvas id="myChart"></canvas>
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
                          label: "@if(count($projectTimelines)>0) {{$projectTimelines[0]->projectName}}  @endif",
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


            var ctx = document.getElementById("myChart");
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
@else
No Record Found    
@endif