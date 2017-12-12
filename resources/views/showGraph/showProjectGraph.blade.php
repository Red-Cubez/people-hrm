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
<section class="showProjectGraphSection">
    <div class="container-fluid">
        <div class="row row-content">
            <div class="col-xs-12">
              @include('showGraph/lineChart')

@if(count($resourcesDetails)>0)
@include('showGraph/pieChart')
@endif  
            </div>
        </div>
    </div>
</section>
