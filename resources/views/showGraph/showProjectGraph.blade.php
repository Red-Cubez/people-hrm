
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
                    ['Project Cost', @foreach($projectTimeLines as $projectTimeline)

                    {{$projectTimeline->cost}},
                        @endforeach
                    ],

                ],
                type: 'spline'
            },
            axis: {
                x: {
                    type: 'category',
                    categories: [ @foreach($projectTimeLines as $projectTimeline)
                        '{{$projectTimeline->monthName}}',
                        @endforeach
                    ]
                }
            }
        });
    </script>
