<?php $sumOfCost = 0; $i=0; ?>

{{-- @foreach($projectsTimelines as $projectTimelines)
@foreach($projectTimelines as $projectTimeline)

{{$projectTimeline->cost}}
@endforeach
@endforeach
{{dd("er")}} --}}
<canvas id="lineChart">
</canvas>
<script type="text/javascript">


    $(document).ready(function () {
      
        new Chart(document.getElementById("lineChart"), {
  type: 'line',
  data: {
     labels: [0,"jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","feb","jan","feb"],
    datasets: [

    @foreach($projectsTimelines as $projectTimelines)
    { 
    
        <?php $i++; ?>

        data: [0, @foreach ($projectTimelines as $projectTimeline)
                      {{$projectTimeline->cost}},
                  @endforeach],
    
        label: "project {{$i}}",
        borderColor: "#3e{{$i*$i+$i}}cd{{$i}}",
        fill: false 
      },
      
     @endforeach 
      { 
    
  
        data: getMonthlyCost(),
    
        label: "Monthly Cost",
        borderColor: "#3e6cd0",
        fill: false 
      },
      
   

    ]
  },
  options: {
    title: {
      display: true,
      text: 'Projects Cost'
    }
  }

});
 });
    function getChartMonthLabel() {
        return [0,
        @foreach ($projectsTimelines as $projectTimelines)
                @foreach ($projectTimelines as $projectTimeline)
            "{{$projectTimeline->monthName}}",
        @endforeach
               @endforeach
       
    ];
    }
     function getMonthlyCost() {
        return [0,
                @foreach ($projectsTimelines as $projectTimelines)
                 @foreach ($projectTimelines as $projectTimeline)
            {

                y: "{{$sumOfCost=$sumOfCost+$projectTimeline->cost}}"
            },
            @endforeach
               @endforeach
        ]
            ;
    }
     
    
</script>
