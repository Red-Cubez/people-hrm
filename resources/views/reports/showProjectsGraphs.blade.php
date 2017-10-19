
@extends('layouts.app')

@section('content')

@if(count($monthlyTimelines) > 0)
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                    <?php
                    $data=serialize($monthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    
                  <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                        {{ csrf_field() }}
                    <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                    <input type="hidden" name="projectsType" value={{$projectsType}}>
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="btn btn-primary">
                                Generate Report
                            </button>
                        </a>
                       
                    </form>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('reports/revenueGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('reports/monthlyCostGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('reports/monthlyProfitGraph')

            </div>
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
    <script src="/js/d3.v3.min.js" charset="utf-8"></script>
    <script src="/js/c3.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

@endsection
