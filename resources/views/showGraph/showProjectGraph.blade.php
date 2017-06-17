
@section('page-scripts')
    @parent
    <!-- Load c3.css -->
    <link href="/css/c3.css" rel="stylesheet">

    <!-- Load d3.js and c3.js -->
    <script src="/js/d3.v3.min.js" charset="utf-8"></script>
    <script src="/js/c3.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@endsection

@include('showGraph/lineChart')

@include('showGraph/pieChart')

