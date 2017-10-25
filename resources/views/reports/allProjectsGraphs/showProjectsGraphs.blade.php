@extends('layouts.app')

@section('content')
@if(isset($isAllProjectsGraphs) )
<div class="container">
    <div class="row">
        Internal Projects Graphs
           @if(count($internalProjectsmonthlyTimelines)>0)

             <div class="row">
            <div class="col-sm-8">
                    <?php
                    $data=null;
                    $data=serialize($internalProjectsmonthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    
                  <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                        {{ csrf_field() }}
                    <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                    <input type="hidden" name="projectsType" value="internalProjects">
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="btn btn-primary">
                                Generate Internal Projects Report
                            </button>
                        </a>
                       
                  </form>

            </div>
        <div class="col-md-2">
          <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
             {{ csrf_field() }}
            <input type="hidden" name="projectsTimelines" value="{{$data}}">
            <button class="btn btn-primary" type="submit">Export Internal Projects Report to Ms Excel</button>
          </form>

        </div>   
        </div>
        <div class="col-sm-8">
    
         
            @include('reports/allProjectsGraphs/showInternalProjectsGraphs/showInternalProjectsGraphs',
                [
                    'internalProjectsmonthlyTimelines'        => $internalProjectsmonthlyTimelines,
                  
                    ])
             
        </div>
         @else
            No Record Found    
         @endif  
    </div>
    <div class="row">
        Client Projects Graphs
         @if(count($clientProjectsmonthlyTimelines)>0)
          <div class="col-sm-8">
                    <?php
                    $data=null;
                    $data=serialize($clientProjectsmonthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    
                  <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                        {{ csrf_field() }}
                    <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                    <input type="hidden" name="projectsType" value="clientProjects">
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="btn btn-primary">
                                Generate Client Projects Report 
                            </button>
                        </a>
                       
                  </form>

            </div>
      <div class="col-md-2">
          <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
             {{ csrf_field() }}
            <input type="hidden" name="projectsTimelines" value="{{$data}}">
            <button class="btn btn-primary" type="submit">Export Clinet Projects Report to Ms Excel</button>
          </form>
      </div>2
        <div class="col-sm-8">

             
              @include('reports/allProjectsGraphs/showClientProjectsGraphs/showClientProjectsGraphs',
                [
                    'clientProjectsMonthlyTimelines'        => $clientProjectsmonthlyTimelines,
            
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