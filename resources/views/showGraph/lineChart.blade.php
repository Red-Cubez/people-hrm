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
                            labelString: 'Rupees'
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
{{--@foreach($projectTimeLines as $projectTimeline)--}}

{{--{{$projectTimeline->cost}},--}}
{{--@endforeach--}}
{{--<div id="chart"></div>--}}

{{--<script type="text/javascript">--}}
{{--var chart = c3.generate({--}}
{{--bindto: '#chart',--}}
{{--data: {--}}

{{--columns: [--}}
{{--['Project Cost', @foreach($projectTimeLines as $projectTimeline)--}}

{{--{{$projectTimeline->cost}},--}}
{{--@endforeach--}}
{{--],--}}

{{--['Sum of Cost',  @foreach($projectTimeLines as $projectTimeline)--}}
{{--{{$sum=$sum+$projectTimeline->cost}},--}}

{{--@endforeach--}}
{{--]--}}

{{--],--}}
{{--type: 'spline'--}}
{{--},--}}
{{--axis: {--}}
{{--x: {--}}
{{--type: 'category',--}}
{{--categories: [ @foreach($projectTimeLines as $projectTimeline)--}}
{{--'{{$projectTimeline->monthName}}',--}}
{{--@endforeach--}}
{{--]--}}
{{--}--}}
{{--}--}}
{{--});--}}

{{--</script>--}}
{{--<script type="text/javascript">--}}

{{--google.charts.load('current', {'packages':['line']});--}}
{{--google.charts.setOnLoadCallback(drawChart);--}}

{{--google.charts.load('current', {'packages':['line']});--}}
{{--google.charts.setOnLoadCallback(drawChart);--}}

{{--function drawChart() {--}}

{{--var data = new google.visualization.DataTable();--}}
{{--data.addColumn('number', 'Day');--}}
{{--data.addColumn('number', 'Day');--}}
{{--@foreach($projectTimeLines as $projectTimeLine)--}}
{{--data.addColumn('number', '{{$projectTimeLine->cost}}');--}}
{{--@endforeach--}}

{{--data.addRows([--}}
{{--[1,  37.8, 80.8, 41.8],--}}
{{--[2,  30.9, 69.5, 32.4],--}}
{{--[3,  25.4,   57, 25.7],--}}
{{--[4,  11.7, 18.8, 10.5],--}}
{{--[5,  11.9, 17.6, 10.4],--}}
{{--[6,   8.8, 13.6,  7.7],--}}
{{--[7,   7.6, 12.3,  9.6],--}}
{{--[8,  12.3, 29.2, 10.6],--}}
{{--[9,  16.9, 42.9, 14.8],--}}
{{--[10, 12.8, 30.9, 11.6],--}}
{{--[11,  5.3,  7.9,  4.7],--}}
{{--[12,  6.6,  8.4,  5.2],--}}
{{--[13,  4.8,  6.3,  3.6],--}}
{{----}}
{{--]);--}}

{{--var options = {--}}
{{--chart: {--}}
{{--title: 'Box Office Earnings in First Two Weeks of Opening',--}}
{{--subtitle: 'in millions of dollars (USD)'--}}
{{--},--}}
{{--width: 900,--}}
{{--height: 500--}}
{{--};--}}

{{--var chart = new google.charts.Line(document.getElementById('linechart_material'));--}}

{{--chart.draw(data, google.charts.Line.convertOptions(options));--}}
{{--}--}}

{{--</script>--}}



