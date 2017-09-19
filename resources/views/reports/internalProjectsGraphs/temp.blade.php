
<?php $sumOfCost = 0; $i=0; ?>
<canvas id="lineChart"></canvas>
<script type="text/javascript">

    $(document).ready(function () {
        data = {
           
            
            datasets: [
                {
                    label: "Cost {{$i}} project per Month",
                    data: getMonthlyCost(),
                    fill: false,
                    backgroundColor: "#991d31",
                    borderColor: "#991d31",
                    pointHitRadius: 20
                },
               
            ],
            
            
            labels: getChartMonthLabel()
        };
        var ctx = document.getElementById("lineChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                legend: {
                    position: 'bottom'
                },
                hover: {
                    mode: 'index'
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
                            labelString: '@if(isset($currencyName)){{$currencyName.' '.$currencySymbol}}@endif'
                        },

                    }]
                },
                title: {
                    display: true,
                    text: 'Total Budget vs Total Cost'
                }
            }
        });
    });
   
    function getMonthlySumOfCost() {
        return [0,
                @foreach ($projectsTimelines as $projectTimelines)
                @foreach($projectTimelines as $projectTimeline)
            {

                y: "{{$sumOfCost=$sumOfCost+$projectTimeline->cost}}"
    },
        @endforeach
        @endforeach
    ]
        ;
    }
    function getMonthlyCost() {
        return [0,
                @foreach ($projectsTimelines as $projectTimelines)
                @foreach($projectTimelines as $projectTimeline)
            {

                y: "{{$projectTimeline->cost}}"
            },
            @endforeach
            @endforeach
        ]
            ;
    }
    function getChartMonthLabel() {
        return [0,
         @foreach ($projectsTimelines as $projectTimelines)
                @foreach($projectTimelines as $projectTimeline)
          "{{$projectTimeline->monthName}}",
        @endforeach
        @endforeach
    ]
        
    }

   </script>



