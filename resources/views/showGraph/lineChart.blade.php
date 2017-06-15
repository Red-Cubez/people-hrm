<?php $sum=0; ?>
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

                ['Sum of Cost',  @foreach($projectTimeLines as $projectTimeline)
                    {{$sum=$sum+$projectTimeline->cost}},

                    @endforeach
                ]

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