@extends('layouts.app')

@section('content')
@if(isset($isAllProjectsGraphs) )
<div class="container">
    <div class="row">
        Internal Projects Graphs
           @if(count($internalProjectsTimelines)>0)
        <div class="col-sm-8">
    
         
            @include('reports/allProjectsGraphs/showInternalProjectsGraphs/showInternalProjectsGraphs',
                [
                    'internalProjectsTimelines'        => $internalProjectsTimelines,
                    'internalProjectsStartAndEndDateTimelines' =>$internalProjectsStartAndEndDateTimelines

                    ])
             
        </div>
         @else
            No Record Found    
         @endif  
    </div>
    <div class="row">
        Client Projects Graphs
         @if(count($clientProjectsTimelines)>0)
        <div class="col-sm-8">

             
              @include('reports/allProjectsGraphs/showClientProjectsGraphs/showClientProjectsGraphs',
                [
                    'clientProjectsTimelines'        => $clientProjectsTimelines,
                    'clientProjectsStartAndEndDateTimelines' =>$clientProjectsStartAndEndDateTimelines

                    ])
                      
        </div>
          @else
               No Record Found    
          @endif 
    </div>
</div>
@else
No Record Found    
@endif
@endsection
@section('page-scripts')
    @parent
<!-- Load c3.css -->
<link href="/css/c3.css" rel="stylesheet">
    <!-- Load d3.js and c3.js -->
    <script charset="utf-8" src="/js/d3.v3.min.js">
    </script>
    <script src="/js/c3.min.js">
    </script>
    <script src="https://www.gstatic.com/charts/loader.js" type="text/javascript">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js">
    </script>
    @endsection
</link>