<?php $i=0; ?>

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
                labels: getChartMonthLabel(),
                datasets: [
                          @foreach($monthlyTimelines as $monthlyTimeline)
                             @if($i>0)
                               {

                                 label: "@if(count($monthlyTimeline)>0) {{$monthlyTimeline[0]->projectName}}  @endif",
                                 data:  [ 

                                          @foreach($monthlyTimeline as $monthlyTimelineItem)
                                          @if($monthlyTimelineItem->isActive)
                                            {                    
                                                 x: "{{$monthlyTimelineItem->monthName}}",

                                                 y: "{{$monthlyTimelineItem->totalCost}}",

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
                                 backgroundColor: "#991d31",
                                 borderColor: "#991d31",
                                 pointHitRadius: 20,
                               },
                              @endif
                                 <?php $i++; ?>
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
      

        
        function getChartMonthLabel() {

            return [
                @foreach ($monthlyTimelines[0] as $monthlyTimeline)

                    "{{$monthlyTimeline->monthName}}",
                @endforeach
            ];
        }
         function getMonthlyCost()
         {

           return [ @foreach($monthlyTimelines[0] as $monthlyTimeline )
                     
                      {
                                           
                                         x: "{{$monthlyTimeline->monthName}}",

                                         y: "{{$monthlyTimeline->totalCost}}",
                                 
                    },
                      @endforeach
              
                      
                     
                ];

         }
</script>
