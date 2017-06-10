
@section('page-scripts')
    @parent
    <!-- Load c3.css -->
    <link href="/css/c3.css" rel="stylesheet">

    <!-- Load d3.js and c3.js -->
    <script src="/js/d3.v3.min.js" charset="utf-8"></script>
    <script src="/js/c3.min.js"></script>

@endsection

<div id="chart"></div>
    <script type="text/javascript">
        var chart = c3.generate({
            bindto: '#chart',
            data: {
                columns: [
                    ['cost', 30, 200, 100, 400, 150, 250,1000,1],

                ],
                type: 'spline'
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep']
                }
            }
        });
    </script>




{{--<h2>Chart </h2>--}}
{{--<div>--}}
{{--<canvas id="myChart"></canvas>--}}
{{--</div>--}}
{{--<script >--}}

{{--var ctx = document.getElementById('myChart').getContext('2d');--}}
{{--var myChart = new Chart(ctx, {--}}
{{--type: 'line',--}}
{{--data: {--}}
{{--labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July','Aug','Sept','Oct','Nov','Dec'],--}}
{{--datasets: [{--}}
{{--label: 'Profit',--}}
{{--data: [12, 19, 3, 17, 6, 3, 7,8],--}}
{{--backgroundColor: "rgba(153,255,51,0.4)"--}}
{{--},]--}}
{{--}--}}
{{--});--}}

{{--</script>--}}
