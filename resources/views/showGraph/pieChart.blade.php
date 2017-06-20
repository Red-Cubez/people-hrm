<div id="pieChart"></div>
<script>
    var chart = c3.generate({

        bindto: '#pieChart',
        data: {
// iris data from R
            columns: [
                    @foreach($resourcesDetails as $resourcesDetail)
                ['{{$resourcesDetail->resourceName}}', {{$resourcesDetail->costPercentage}},],
                @endforeach

            ],
            type: 'pie',
            onclick: function (d, i) {
                console.log("onclick", d, i);
            },
            onmouseover: function (d, i) {
                console.log("onmouseover", d, i);
            },
            onmouseout: function (d, i) {
                console.log("onmouseout", d, i);
            }
        },
        color: {
            pattern: ['#ff9896', '#1f77b4', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
        }
    });


</script>
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

