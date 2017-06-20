<canvas id="pieChart" style="height: 30px;"></canvas>
<script type="text/javascript">

    $(document).ready(function () {
        data = {
            datasets: [{
                data: getChartData(),
                backgroundColor: [
                    '#FF6384',
                    '#FF9F40',
                    '#FFCD56',
                    '#4BC0C0',
                    '#36A2EB',
                    'pink',
                ]
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: getChartLabel()
        };008080

        var ctx = document.getElementById("pieChart")

        var myLineChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                legend: {
                    position: 'bottom'
                },
                hover: {
                    mode: 'index'
                },

                title: {
                    display: true,
                    text: 'Resources Cost'
                }
            }
        });
    });

    function getChartData() {
        return [
            @foreach ($resourcesDetails as $resourcesDetail)


                "{{$resourcesDetail->costPercentage}}",

            @endforeach
        ];
    }
    function getChartLabel() {
        return [
            @foreach ($resourcesDetails as $resourcesDetail)
                '{{$resourcesDetail->resourceName}}',
            @endforeach
        ]
            ;
    }

</script>

{{--<div id="pieChart"></div>--}}
{{--<script>--}}
{{--var chart = c3.generate({--}}

{{--bindto: '#pieChart',--}}
{{--data: {--}}
{{--// iris data from R--}}
{{--columns: [--}}
{{--@foreach($resourcesDetails as $resourcesDetail)--}}
{{--['{{$resourcesDetail->resourceName}}', {{$resourcesDetail->costPercentage}},],--}}
{{--@endforeach--}}

{{--],--}}
{{--type: 'pie',--}}
{{--onclick: function (d, i) {--}}
{{--console.log("onclick", d, i);--}}
{{--},--}}
{{--onmouseover: function (d, i) {--}}
{{--console.log("onmouseover", d, i);--}}
{{--},--}}
{{--onmouseout: function (d, i) {--}}
{{--console.log("onmouseout", d, i);--}}
{{--}--}}
{{--},--}}
{{--color: {--}}
{{--pattern: ['#ff9896', '#1f77b4', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']--}}
{{--}--}}
{{--});--}}


{{--</script>--}}
{{--<div id="piechart" style="width: 700px; height: 500px;"></div>--}}
{{--<script type="text/javascript">--}}
{{--google.charts.load("current", {packages: ["corechart"]});--}}
{{--google.charts.setOnLoadCallback(drawChart);--}}
{{--function drawChart() {--}}
{{--var data = google.visualization.arrayToDataTable([--}}
{{--['Resource', 'Total Cost(percent)'],--}}
{{--@foreach($resourcesDetails as $resourcesDetail)--}}
{{--['{{$resourcesDetail->resourceName}}', {{($resourcesDetail->cost / $projectTotalCost)*100}}],--}}
{{--@endforeach--}}

{{--]);--}}

{{--var options = {--}}
{{--title: 'Resources Cost Percentage',--}}
{{--legend: 'yes',--}}
{{--pieSliceText: 'label',--}}
{{--slices: {--}}
{{--1: {offset: 0.2},--}}
{{--4: {offset: 0.3},--}}
{{--8: {offset: 0.4},--}}
{{--10: {offset: 0.5},--}}
{{--},--}}
{{--};--}}

{{--var chart = new google.visualization.PieChart(document.getElementById('piechart'));--}}
{{--chart.draw(data, options);--}}
{{--//}--}}
{{--//</script>--}}

