
<?php $sumOfCost = 0; $profit=$project->budget;?>
<canvas id="lineChart"></canvas>
<script type="text/javascript">

    $(document).ready(function () {
        data = {
            datasets: [
                {
                    label: "Cost Per Month",
                    data: getMonthlyCost(),
                    fill: false,
                    backgroundColor: "#991d31",
                    borderColor: "#991d31",
                    pointHitRadius: 20
                },

                {
                    label: "Monthly Cost Sum",
                    data: getMonthlySumOfCost(),
                    fill: false,
                    backgroundColor: "#9966FF",
                    borderColor: "#9966FF",
                    pointHitRadius: 20
                },
                {
                    label: "Profit",
                    data: getProfit(),
                    fill: false,
                    backgroundColor: "#44AC0F",
                    borderColor: "#44AC0F",
                    pointHitRadius: 20
                }


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
    function getProfit() {

       return  [{{$profit}},
           @foreach ($projectTimeLines as $projectTimeline)
           "{{$profit=$profit-($sumOfCost+$projectTimeline->cost)}}",
           @endforeach

       ];
    }
    function getMonthlySumOfCost() {
        return [0,
                @foreach ($projectTimeLines as $projectTimeline)
            {

                y: "{{$sumOfCost=$sumOfCost+$projectTimeline->cost}}"
    },
        @endforeach
    ]
        ;
    }
    function getMonthlyCost() {
        return [0,
                @foreach ($projectTimeLines as $projectTimeline)
            {

                y: "{{$projectTimeline->cost}}"
            },
            @endforeach
        ]
            ;
    }
    function getChartMonthLabel() {
        return [0,
        @foreach ($projectTimeLines as $projectTimeline)
    "{{$projectTimeline->monthName}}",
        @endforeach
    ]
        ;
    }

   </script>



