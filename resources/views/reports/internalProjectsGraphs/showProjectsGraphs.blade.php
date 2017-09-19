
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @include('reports/internalProjectsGraphs/monthlyCostGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
              {{--   @include('internalProjectGraphs/monthlyProfitGraph')
 --}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
               {{--  @include('internalProjectGraphs/netTotalGraph')
 --}}
            </div>
        </div>

    
    </div>
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
