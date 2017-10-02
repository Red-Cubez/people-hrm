<?php $i=0; $projectNames=array(); ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="width: 600px; height: 400px;display: block;">
            <canvas id="myChartWithCost">
            </canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    data = {     
                datasets: [
                        {
                          data: getChartData(),                                  
                          label: "test",
                          fill: false,
                          backgroundColor: "#991d31",
                          borderColor: "#991d31",
                          pointHitRadius: 20,
                        },
         
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
      
 function getChartData()
  {
    return [
                    @foreach (($monthlyTimelines as $monthlyTimeline)
                    /                     
                        x: "{{$monthlyTimeline->monthName}}",
                        y: "{{$monthlyTimeline->totalCost}}"
                    },
                    @endforeach
            ];
          
  
  
        }
        
        function getChartMonthLabel() {

            return [0,
                @foreach ($monthlyTimelines as $monthlyTimeline)
                    "{{$monthlyTimeline->monthName}}",
                @endforeach
            ];
        }
         function getMonthlyCost()
         {

           return [0, @foreach($monthlyTimelines as $monthlyTimeline )
                     
                      
                                           "{{$monthlyTimeline->totalCost}}",
                                 
                    
                      @endforeach
              
                      
                     
                ];

         }
</script>
