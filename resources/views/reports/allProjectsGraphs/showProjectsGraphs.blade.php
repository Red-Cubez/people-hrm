@extends('layouts.app')
@section('content')
@if(isset($isAllProjectsGraphs) )
<article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Internal Projects Graphs</h1>
                </div>
            </div>
        </div>
</article>
<section class="showAllProjectsGraphSection">
  <div class="container-fluid">
    <div class="row">
    @if(count($internalProjectsmonthlyTimelines)>0)
     <div class="row row-content100">
             <div class="col-sm-12 col-xs-12 col-md-12">
                    <?php
                    $data=null;
                    $data=serialize($internalProjectsmonthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    <div class="aParent">
                            <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                                  {{ csrf_field() }}
                              <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                              <input type="hidden" name="projectsType" value="internalProjects">
                                  <a href="/company/{{$companyId}}/all-projects/report">
                                      <button class="button button40">
                                          Generate Internal Projects Report
                                      </button>
                                  </a>
                                 
                            </form>
                             <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
                       {{ csrf_field() }}
                       <input type="hidden" name="projectsTimelines" value="{{$data}}">
                      <button class="button button40" type="submit">Export Internal Projects Report to Ms Excel</button>
                       </form>
                 </div>
            </div>
        </div>
        <div class="row row-content100">
        <div class="col-sm-12 col-xs-12 col-md-12">
         @include('reports/allProjectsGraphs/showInternalProjectsGraphs/showInternalProjectsGraphs',
                [
                    'internalProjectsmonthlyTimelines'        => $internalProjectsmonthlyTimelines,
                  
                    ])
             
        </div>
         @else
            No Record Found    
         @endif  
         </div>
    </div>
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Client Projects Graphs</h1>
                </div>
            </div>
        </div>
</article>
    <div class="row row-content100">
      
         @if(count($clientProjectsmonthlyTimelines)>0)
          <div class="col-sm-12 col-xs-12 col-md-12">
                    <?php
                    $data=null;
                    $data=serialize($clientProjectsmonthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    <div class="aParent">
                  <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                        {{ csrf_field() }}
                    <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                    <input type="hidden" name="projectsType" value="clientProjects">
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="button button40">
                                Generate Client Projects Report 
                            </button>
                        </a>
                       
                  </form>
                   <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
                   {{ csrf_field() }}
                  <input type="hidden" name="projectsTimelines" value="{{$data}}">
                  <button class="button button40" type="submit">Export Clinet Projects Report to Ms Excel</button>
                </form>
               </div>
            </div>
         </div>
         <div class="row row-content100">
        <div class="col-sm-12 col-xs-12 col-md-12">

             
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
</section>
@else
No Record Found    
@endif
@endsection
@section('page-scripts')
    @parent

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
