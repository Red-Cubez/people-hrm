    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
@if(count($monthlyTimelines) > 0)
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
@else
	No Record Found    
@endif