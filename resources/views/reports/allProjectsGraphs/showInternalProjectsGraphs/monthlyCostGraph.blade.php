<?php $i=0; ?>

<div class="panel panel-default">
    <div class="panel-body">
        <div style="width: 600px; height: 400px;display: block;">
            <canvas id="internalProjectsChartWithCost">
            </canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    data = {
                labels: getChartMonthLabel(),
                datasets: [
                          @foreach($internalProjectsmonthlyTimelines as $monthlyTimeline)
                             @if($i>0)
                               {

                                 label: @if(count($monthlyTimeline)>0) "{{$monthlyTimeline[0]->projectName}}",  @endif
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
                                 label: "Monthly Cost",
                                 data:  getMonthlyCost(),
                                 fill: false,
                                 backgroundColor: "red",
                                 borderColor: "red",
                                 pointHitRadius: 20,  
                                 },

                          ],
               
               
              };


            var ctx = document.getElementById("internalProjectsChartWithCost");
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
                        text: 'Projects Monthly Cost'
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
         function getMonthlyCost()
         {

           return [ @foreach($internalProjectsmonthlyTimelines[0] as $monthlyTimeline )
                     
                      {
                                           
                                         x: "{{$monthlyTimeline->monthName}}",

                                         y: "{{$monthlyTimeline->totalCost}}",
                                 
                    },
                      @endforeach
              
                      
                     
                ];

         }

         function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
</script>
